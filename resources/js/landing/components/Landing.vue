<template>
  <section class="hero" ref="heroRef">
    <div v-for="(slide, index) in slides" :key="index" class="slide" :class="{ active: index === current, prev: index === prevIndex, 'slide-borobudur': index === 0 }">
      <img :src="slide.image" :alt="slide.name" loading="lazy">
    </div>

    <div class="overlay"></div>

    <div class="content">
      <div class="text">
        <span class="label">{{ slides[current].location }}</span>
        <h2 class="title">{{ slides[current].name }}</h2>
        <p class="desc">{{ slides[current].desc }}</p>
      </div>
    </div>

    <div class="controls" ref="controlsRef">
      <p class="visit-text" ref="visitTextRef">Visit Indonesia's<br>tourist destinations</p>
      <div class="thumbs">
        <button
          v-for="(slide, index) in slides"
          :key="index"
          class="thumb"
          :class="{ active: index === current }"
          @click="goTo(index)"
        >
          <img :src="slide.image" :alt="slide.name" loading="lazy">
        </button>
      </div>
      <div class="counter">
        <span class="num">{{ formatted(current) }}</span>
        <span class="sep">—</span>
        <span class="total">{{ formatted(slides.length - 1) }}</span>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const current = ref(0)
const prevIndex = ref(-1)
const heroRef = ref(null)
const controlsRef = ref(null)
const visitTextRef = ref(null)
let interval

const slides = [
  {
    image: '/borobudur.jpg',
    name: 'Borobudur',
    location: 'Java Center',
    desc: 'Temples, surf, and sunset — the Island of the Gods awaits.'
  },
  {
    image: '/tumpak_sewu.jpg',
    name: 'Tumpak Sewu',
    location: 'Lumajang',
    desc: 'A majestic curtain of water falling into a lush emerald canyon.'
  },
  {
    image: '/prambanan.jpg',
    name: 'Prambanan',
    location: 'Yogyakarta',
    desc: 'Blue flames and a turquoise crater lake, a surreal volcanic wonder.'
  },
  {
    image: '/bromo.jpg',
    name: 'Bromo',
    location: 'East Java',
    desc: 'Watch the sunrise over an ancient volcanic landscape from the sea of sand.'
  }
]

function goTo(index) {
  if (index === current.value) {
return
}

  prevIndex.value = current.value
  current.value = index
  resetInterval()
}

function formatted(n) {
  return String(n + 1).padStart(2, '0')
}

function resetInterval() {
  clearInterval(interval)
  interval = setInterval(next, 5000)
}

function next() {
  prevIndex.value = current.value
  current.value = (current.value + 1) % slides.length
}

let handleScroll

onMounted(() => {
  handleScroll = () => {
    const value = window.scrollY
    const imgs = heroRef.value?.querySelectorAll('.slide img')

    if (imgs) {
      imgs.forEach(el => {
        el.style.transform = `translateY(${value * 0.12}px) scale(1.1)`
      })
    }

    if (controlsRef.value) {
      controlsRef.value.style.transform = `translateY(${-value * 0.08}px)`
      controlsRef.value.style.opacity = Math.max(0, 1 - value / 500)
    }

    if (visitTextRef.value) {
      visitTextRef.value.style.transform = `translateY(${-value * 0.15}px)`
    }
  }

  window.addEventListener('scroll', handleScroll)
  interval = setInterval(next, 5000)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  clearInterval(interval)
})
</script>

<style scoped>
.hero {
  position: relative;
  height: 100vh;
  overflow: hidden;
  display: flex;
  align-items: center;
}

.slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  transition: opacity 1s ease, transform 1.2s ease;
  transform: scale(1.05);
}

.slide.active {
  opacity: 1;
  transform: scale(1);
  z-index: 1;
}

.slide.prev {
  opacity: 0;
  transform: scale(1.05);
  z-index: 0;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  will-change: transform;
}

.slide-borobudur img {
  object-position: center 70%;
}

.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, rgba(13, 13, 18, 0.7) 0%, rgba(13, 13, 18, 0.2) 60%, transparent 100%);
  z-index: 2;
}

.hero::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 12%;
  background: linear-gradient(to top, #0d0d12, transparent);
  z-index: 3;
  pointer-events: none;
}

.content {
  position: relative;
  z-index: 4;
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 60px;
}

.text {
  max-width: 520px;
}

.label {
  display: inline-block;
  font-size: 0.85em;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 16px;
  background: rgba(167, 139, 250, 0.12);
  padding: 6px 16px;
  border-radius: 20px;
  border: 1px solid rgba(167, 139, 250, 0.2);
}

.title {
  font-size: 4.5em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.1;
  margin-bottom: 16px;
  letter-spacing: -1.5px;
}

.desc {
  font-size: 1.05em;
  color: #d4d4d8;
  line-height: 1.7;
}

.controls {
  position: absolute;
  right: 60px;
  bottom: 60px;
  z-index: 5;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 16px;
}

.thumbs {
  display: flex;
  gap: 12px;
}

.thumb {
  width: 100px;
  height: 72px;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  border: 2px solid rgba(255, 255, 255, 0.15);
  padding: 0;
  background: none;
  transition: all 0.4s ease;
  opacity: 0.5;
  filter: grayscale(0.6);
}

.thumb.active {
  opacity: 1;
  border-color: #a78bfa;
  filter: grayscale(0);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(167, 139, 250, 0.3);
}

.thumb:hover {
  opacity: 0.8;
  border-color: rgba(167, 139, 250, 0.5);
}

.thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.visit-text {
  font-size: 1.15em;
  color: #d4d4d8;
  text-align: right;
  line-height: 1.5;
  letter-spacing: 0.5px;
  margin: 0 0 12px;
  font-weight: 400;
}

.counter {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.9em;
  color: #9ca3af;
  letter-spacing: 2px;
  font-weight: 400;
}

.num {
  color: #ffffff;
  font-weight: 600;
}

.sep {
  color: #52525b;
}

.total {
  color: #71717a;
}

@media (max-width: 900px) {
  .content {
    padding: 0 24px;
  }

  .controls {
    right: 24px;
    bottom: 40px;
  }

  .title {
    font-size: 3em;
  }

  .thumb {
    width: 76px;
    height: 56px;
  }
}

@media (max-width: 640px) {
  .title {
    font-size: 2.2em;
  }

  .desc {
    font-size: 0.95em;
  }

  .controls {
    right: 16px;
    bottom: 30px;
    gap: 12px;
  }

  .thumbs {
    gap: 6px;
  }

  .thumb {
    width: 90px;
    height: 66px;
    border-radius: 6px;
  }

  .counter {
    font-size: 0.8em;
  }
}
</style>
