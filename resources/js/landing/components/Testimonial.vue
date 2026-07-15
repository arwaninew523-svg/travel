<template>
  <section class="testimonial">
    <div class="parallax-bg" ref="parallaxBg"></div>
    <div class="overlay"></div>

    <div class="container">
      <div class="content">
        <div class="left">
          <h2 class="headline">Discover the world <br>in a new way.</h2>
          <p class="desc">
            Attachment to material things and comfort is the main obstacle to an exciting life.
            People, as a general rule, do not realize that at any moment they can cast anything
            out of their lives. At any moment. Instantly.
          </p>
        </div>

        <div class="right">
          <div v-for="(item, index) in items" :key="index" class="testi-bar">
            <div class="bar-avatar" :style="{ backgroundImage: `url(${item.avatar})` }"></div>
            <div class="bar-content">
              <p class="bar-quote">"{{ item.quote }}"</p>
              <div class="bar-meta">
                <strong>{{ item.name }}</strong>
                <span class="bar-stars">{{ '★'.repeat(item.stars) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";

const parallaxBg = ref(null)
const items = [
  {
    avatar: 'https://images.unsplash.com/photo-1488161628813-04466f872be2?w=100&q=80',
    name: 'Sarah Chen',
    stars: 5,
    quote: 'The Bromo sunrise tour was absolutely breathtaking!'
  },
  {
    avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&q=80',
    name: 'James Williams',
    stars: 5,
    quote: 'Ijen crater blue fire is truly a once-in-a-lifetime experience.'
  },
  {
    avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&q=80',
    name: 'Maria Gonzalez',
    stars: 5,
    quote: 'Bali exceeded all my expectations. Unforgettable trip!'
  },
  {
    avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=80',
    name: 'David Park',
    stars: 5,
    quote: 'Tumpak Sewu waterfall was the highlight of my Java trip.'
  }
]

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
  flex: 0 0 420px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.testi-bar {
  display: flex;
  gap: 16px;
  align-items: flex-start;
  background: rgba(24, 24, 27, 0.7);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 14px;
  padding: 18px 22px;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.testi-bar:hover {
  transform: translateX(-6px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
  border-color: rgba(167, 139, 250, 0.4);
}

.bar-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background-size: cover;
  background-position: center;
  flex-shrink: 0;
  border: 2px solid rgba(167, 139, 250, 0.3);
}

.bar-content {
  flex: 1;
  min-width: 0;
}

.bar-quote {
  color: #d4d4d8;
  font-size: 0.88em;
  line-height: 1.5;
  margin-bottom: 8px;
  font-style: italic;
}

.bar-meta {
  display: flex;
  align-items: center;
  gap: 10px;
}

.bar-meta strong {
  color: #ffffff;
  font-size: 0.85em;
  font-weight: 500;
}

.bar-stars {
  color: #fbbf24;
  font-size: 0.8em;
  letter-spacing: 1px;
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

  .testi-bar {
    padding: 14px 16px;
  }
}
</style>
