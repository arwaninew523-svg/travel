<template>
  <section class="our-reach">
    <div class="reach-bg"></div>
    <div class="reach-content">
      <div class="reach-header">
        <span class="reach-badge">Our Reach</span>
        <h3 class="reach-title">Most Visited Destinations</h3>
        <p class="reach-desc">
          These are the top destinations that travelers love the most. From ancient temples
          to tropical paradises, each location offers a unique experience that keeps visitors
          coming back year after year.
        </p>
        <div class="reach-total">
          <span class="total-number">10.8M+</span>
          <span class="total-label">Total Visitors</span>
        </div>
      </div>

      <div class="cards-grid">
        <div
          v-for="(item, index) in stats"
          :key="index"
          class="dest-card"
          :class="{ 'dest-card-active': activeCard === index }"
          @mouseenter="activeCard = index"
          @mouseleave="activeCard = null"
        >
          <div class="dest-card-image">
            <img :src="item.image" :alt="item.name" />
            <div class="dest-card-overlay"></div>
            <div class="dest-card-visitors">
              <span class="dest-card-number">{{ item.visitors }}</span>
              <span class="dest-card-label">visitors</span>
            </div>
          </div>
          <div class="dest-card-body">
            <div class="dest-card-info">
              <div class="dest-card-name">{{ item.name }}</div>
              <div class="dest-card-location">{{ item.location }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from "vue";

const activeCard = ref(null)

const stats = [
  {
    name: 'Borobudur',
    location: 'Magelang, Jawa Tengah',
    visitors: '2.5M',
    image: 'https://images.unsplash.com/photo-1615104168825-3d6391ccc228?q=80&w=870'
  },
  {
    name: 'Bali',
    location: 'Kepulauan Sunda Kecil',
    visitors: '6.3M',
    image: 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=870'
  },
  {
    name: 'Bromo',
    location: 'Probolinggo, Jawa Timur',
    visitors: '1.2M',
    image: 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?q=80&w=870'
  },
  {
    name: 'Raja Ampat',
    location: 'Papua Barat',
    visitors: '850K',
    image: 'https://images.unsplash.com/photo-1590461478695-34e06f7af549?q=80&w=870'
  }
]
</script>

<style scoped>
.our-reach {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 100px 20px;
}

.reach-bg {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, #0d0d12 0%, #111118 50%, #0d0d12 100%);
  z-index: 0;
}

.reach-content {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1200px;
  display: flex;
  flex-direction: column;
  gap: 60px;
}

.reach-header {
  text-align: center;
  max-width: 640px;
  margin: 0 auto;
}

.reach-badge {
  display: inline-block;
  font-size: 0.78em;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 14px;
  background: rgba(167, 139, 250, 0.1);
  padding: 5px 14px;
  border-radius: 20px;
  border: 1px solid rgba(167, 139, 250, 0.15);
}

.reach-title {
  font-size: 2.4em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.2;
  margin-bottom: 18px;
  letter-spacing: -1px;
}

.reach-desc {
  font-size: 0.95em;
  color: #a1a1aa;
  line-height: 1.8;
  margin-bottom: 28px;
}

.reach-total {
  display: inline-flex;
  align-items: center;
  gap: 14px;
  background: rgba(167, 139, 250, 0.06);
  border: 1px solid rgba(167, 139, 250, 0.12);
  border-radius: 14px;
  padding: 14px 24px;
}

.total-number {
  font-size: 1.8em;
  font-weight: 700;
  color: #a78bfa;
  line-height: 1;
}

.total-label {
  font-size: 0.85em;
  color: #71717a;
  font-weight: 400;
}

.cards-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.dest-card {
  background: linear-gradient(145deg, rgba(30, 30, 35, 0.9), rgba(22, 22, 28, 0.95));
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 18px;
  overflow: hidden;
  transition: all 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
  cursor: pointer;
  box-shadow:
    0 4px 20px rgba(0, 0, 0, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.04);
}

.dest-card-active {
  border-color: rgba(167, 139, 250, 0.3) !important;
  box-shadow:
    0 20px 60px rgba(0, 0, 0, 0.5),
    0 0 40px rgba(167, 139, 250, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
  transform: translateY(-6px);
}

.dest-card-image {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 10;
  overflow: hidden;
}

.dest-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.dest-card:hover .dest-card-image img {
  transform: scale(1.1);
}

.dest-card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, transparent 60%);
}

.dest-card-visitors {
  position: absolute;
  bottom: 12px;
  right: 14px;
  text-align: right;
}

.dest-card-number {
  display: block;
  font-size: 1.2em;
  font-weight: 700;
  background: linear-gradient(135deg, #a78bfa, #c4b5fd);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1;
  margin-bottom: 2px;
}

.dest-card-label {
  font-size: 0.6em;
  color: #a1a1aa;
  text-transform: uppercase;
  letter-spacing: 1.2px;
}

.dest-card-body {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px 18px;
}

.dest-card-icon {
  font-size: 1.4em;
  flex-shrink: 0;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(167, 139, 250, 0.12), rgba(167, 139, 250, 0.04));
  border: 1px solid rgba(167, 139, 250, 0.1);
  border-radius: 12px;
}

.dest-card-info {
  flex: 1;
  min-width: 0;
}

.dest-card-name {
  font-size: 0.95em;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 3px;
  letter-spacing: 0.3px;
}

.dest-card-location {
  font-size: 0.75em;
  color: #63636e;
  letter-spacing: 0.2px;
}

@media (max-width: 1024px) {
  .cards-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 900px) {
  .our-reach {
    padding: 80px 16px;
  }

  .reach-title {
    font-size: 2em;
  }

  .reach-content {
    gap: 40px;
  }
}

@media (max-width: 600px) {
  .cards-grid {
    grid-template-columns: 1fr;
    max-width: 400px;
    margin: 0 auto;
  }

  .reach-title {
    font-size: 1.6em;
  }
}
</style>
