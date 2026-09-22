<script setup>
import { onMounted, onUnmounted, ref } from "vue";

const parallaxBg = ref(null);
let handleScroll;

onMounted(() => {
  // Load Script Elfsight secara dinamis
  const scriptId = 'elfsight-platform-script';
  if (!document.getElementById(scriptId)) {
    const script = document.createElement('script');
    script.id = scriptId;
    script.src = 'https://elfsightcdn.com/platform.js';
    script.async = true;
    document.body.appendChild(script);
  }

  // Handle Efek Parallax Background
  handleScroll = () => {
    if (parallaxBg.value) {
      const rect = parallaxBg.value.getBoundingClientRect();
      const speed = 0.3;
      parallaxBg.value.style.transform = `translateY(${rect.top * speed}px)`;
    }
  };
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  if (handleScroll) {
    window.removeEventListener('scroll', handleScroll);
  }
});
</script>

<template>
  <section class="testimonial">
    <div class="parallax-bg" ref="parallaxBg"></div>
    <div class="overlay"></div>

    <div class="container">
      <div class="content">
        <!-- Sisi Kiri: Headline & Deskripsi -->
        <div class="left">
          <h2 class="headline">Discover the world <br>in a new way.</h2>
          <p class="desc">
            Attachment to material things and comfort is the main obstacle to an exciting life.
            People, as a general rule, do not realize that at any moment they can cast anything
            out of their lives. At any moment. Instantly.
          </p>
        </div>

        <!-- Sisi Kanan: Widget Google Reviews Elfsight -->
        <div class="right">
          <div class="elfsight-container">
            <div class="elfsight-app-f2b2c4d4-42e8-49ff-add1-dff3e8a2216d" data-elfsight-app-lazy></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.testimonial {
  position: relative;
  padding: 120px 20px;
  overflow: hidden;
  min-height: 100vh;
  display: flex;
  align-items: center;
}

.parallax-bg {
  position: absolute;
  inset: -20% 0;
  background:
    linear-gradient(135deg, rgba(10, 10, 20, 0.4) 0%, rgba(20, 15, 40, 0.6) 100%),
    url('https://images.unsplash.com/photo-1703769605297-cc74106244d9?q=80&w=884') center / cover no-repeat;
  will-change: transform;
  z-index: 0;
}

.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(13, 13, 18, 0.3) 0%, rgba(13, 13, 18, 0.85) 100%);
  z-index: 1;
}

.container {
  position: relative;
  z-index: 2;
  max-width: 1100px;
  margin: 0 auto;
  width: 100%;
}

.content {
  display: flex;
  gap: 60px;
  align-items: center;
}

.left {
  flex: 1;
}

.headline {
  font-size: 3.2em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.2;
  margin-bottom: 20px;
  letter-spacing: -1px;
}

.desc {
  font-size: 1em;
  color: #a1a1aa;
  line-height: 1.8;
  max-width: 480px;
}

.right {
  flex: 0 0 460px;
  display: flex;
  flex-direction: column;
}

.elfsight-container {
  background: rgba(24, 24, 27, 0.4);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 20px;
  padding: 10px;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
}

@media (max-width: 960px) {
  .content {
    flex-direction: column;
    gap: 40px;
  }

  .headline {
    font-size: 2.2em;
  }

  .right {
    flex: none;
    width: 100%;
  }

  .testimonial {
    padding: 80px 16px;
  }
}

@media (max-width: 640px) {
  .headline {
    font-size: 1.8em;
  }

  .elfsight-container {
    padding: 10px;
  }
}
</style>