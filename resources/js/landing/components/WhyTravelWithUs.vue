<template>
  <section class="why-us">
    <div class="container">
      <h2 class="section-title">Why Travel With Us?</h2>
      <p class="section-subtitle">We make your journey unforgettable from start to finish</p>

      <div class="grid">
        <div v-for="(item, index) in items" :key="index" class="card">
          <div class="icon">
            <span v-html="item.icon"></span>
          </div>
          <h3>{{ item.title }}</h3>
          <p>{{ item.desc }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const items = [
  {
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>',
    title: 'Local Experience',
    desc: 'Discover the authentic culture and traditions of your destination with our local guides.'
  },
  {
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>',
    title: 'Flexible Journey',
    desc: 'Your trip, your schedule, your style.'
  },
  {
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>',
    title: 'Private & Comfortable',
    desc: 'Comfortable accommodations and private transportation for a stress-free experience.'
  },
  {
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>',
    title: 'Personal Service',
    desc: 'We help you from the first moment you contact us.'
  }
]
</script>

<style scoped>
.why-us {
  position: relative;
  padding: 100px 20px;
  background: #15151c;
}

.container {
  max-width: 1000px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  font-size: 4.5em;
  color: #ffffff;
  margin-bottom: 8px;
}

.section-subtitle {
  text-align: center;
  font-size: 1.1em;
  color: #9ca3af;
  margin-bottom: 60px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

.card {
  background: rgba(24, 24, 27, 0.6);
  border-radius: 16px;
  padding: 36px 30px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.06);
}

.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
  border-color: rgba(167, 139, 250, 0.3);
}

.icon {
  width: 56px;
  height: 56px;
  background: #a78bfa;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
  color: #ffffff;
}

.card h3 {
  font-size: 1.2em;
  color: #ffffff;
  margin-bottom: 10px;
  font-weight: 600;
}

.card p {
  font-size: 0.95em;
  color: #9ca3af;
  line-height: 1.7;
  margin: 0;
}

@media (max-width: 640px) {
  .why-us {
    padding: 60px 16px;
  }

  .section-title {
    font-size: 1.8em;
  }

  .grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .card {
    padding: 28px 24px;
  }
}
</style>
