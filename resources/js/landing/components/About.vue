<template>
  <section class="about">
    <div class="parallax-bg" ref="parallaxBg"></div>
    <div class="overlay"></div>

    <div class="hero-content">
      <span class="badge">About Us</span>
      <h2 class="hero-title">Explore the Beauty of<br>Indonesia With Us</h2>
      <p class="hero-desc">
        This website is an Indonesian travel guide platform that provides information
        on the best destinations, travel packages, and vacation inspiration.
        From Sabang to Merauke,
        we're here to help you discover unforgettable experiences in every corner of the archipelago.

      </p>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";

const parallaxBg = ref(null)

let handleScroll

onMounted(() => {
  handleScroll = () => {
    if (parallaxBg.value) {
      const rect = parallaxBg.value.getBoundingClientRect()
      const speed = 0.3
      parallaxBg.value.style.transform = `translateY(${rect.top * speed}px)`
    }
  }
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.about {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 140px 20px 100px;
}

.parallax-bg {
  position: absolute;
  inset: -20% 0;
  background:
    linear-gradient(135deg, rgba(10, 10, 20, 0.5) 0%, rgba(20, 15, 40, 0.7) 100%),
    url('https://images.unsplash.com/photo-1615104168825-3d6391ccc228?q=80&w=870') center / cover no-repeat;
  will-change: transform;
  z-index: 0;
}

.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(13, 13, 18, 0.4) 0%, rgba(13, 13, 18, 0.92) 100%);
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 700px;
  margin-bottom: 80px;
}

.badge {
  display: inline-block;
  font-size: 0.85em;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 20px;
  background: rgba(167, 139, 250, 0.12);
  padding: 6px 18px;
  border-radius: 20px;
  border: 1px solid rgba(167, 139, 250, 0.2);
}

.hero-title {
  font-size: 3.5em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.15;
  margin-bottom: 24px;
  letter-spacing: -1.5px;
}

.hero-desc {
  font-size: 1.05em;
  color: #a1a1aa;
  line-height: 1.8;
  max-width: 580px;
  margin: 0 auto;
}
@media (max-width: 900px) {
  .hero-title {
    font-size: 2.4em;
  }

  .about {
    padding: 100px 16px 60px;
  }

  .hero-content {
    margin-bottom: 60px;
  }

}
</style>
