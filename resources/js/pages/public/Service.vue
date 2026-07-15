<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";

const activeCard = ref(null)

const services = [
  {
    icon: '🏕️',
    title: 'Tour Packages',
    description: 'Curated group tour packages to top destinations like Bali, Bromo, and Raja Ampat with experienced local guides.',
    image: 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=870'
  },
  {
    icon: '🗺️',
    title: 'Custom Itinerary',
    description: 'Tailor-made travel plans designed around your preferences, budget, and schedule for a personal experience.',
    image: 'https://images.unsplash.com/photo-1488085061387-422e29b40080?q=80&w=870'
  },
  {
    icon: '🚗',
    title: 'Transportation',
    description: 'Reliable airport transfers, inter-city travel, and private car rentals with professional drivers.',
    image: 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=870'
  },
  {
    icon: '🏨',
    title: 'Accommodation',
    description: 'Handpicked hotels, villas, and homestays ranging from budget-friendly to luxury with the best views.',
    image: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=870'
  },
  {
    icon: '🛡️',
    title: 'Travel Insurance',
    description: 'Comprehensive travel protection covering health, baggage, trip cancellation, and emergency assistance.',
    image: 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=870'
  },
  {
    icon: '🎯',
    title: 'Adventure Trips',
    description: 'Thrilling adventures including volcano trekking, diving, white-water rafting, and jungle exploration.',
    image: 'https://images.unsplash.com/photo-1703769605314-502c031fe751?q=80&w=774'
  }
]
</script>

<template>
    <Head title="Service - Ijen Bromo Travel" />

    <section class="service-page">
        <div class="service-bg"></div>
        <div class="service-overlay"></div>

        <div class="service-hero">
            <span class="service-badge">Our Services</span>
            <h1 class="service-title">Travel Services<br>We Provide</h1>
            <p class="service-desc">
                From curated tour packages to personalized itineraries, we offer everything you need
                to make your Indonesian adventure seamless and unforgettable.
            </p>
        </div>

        <div class="services-grid">
            <div
                v-for="(item, index) in services"
                :key="index"
                class="service-card"
                :class="{ 'service-card-active': activeCard === index }"
                @mouseenter="activeCard = index"
                @mouseleave="activeCard = null"
            >
                <div class="service-card-image">
                    <img :src="item.image" :alt="item.title" />
                    <div class="service-card-overlay"></div>
                </div>
                <div class="service-card-body">
                    <div class="service-card-icon">{{ item.icon }}</div>
                    <h3 class="service-card-title">{{ item.title }}</h3>
                    <p class="service-card-desc">{{ item.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.service-page {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 140px 20px 100px;
}

.service-bg {
  position: absolute;
  inset: -20% 0;
  background:
    linear-gradient(135deg, rgba(10, 10, 20, 0.5) 0%, rgba(20, 15, 40, 0.7) 100%),
    url('https://images.unsplash.com/photo-1716458264756-e223a81eb8e1?q=80') top / cover no-repeat;
  z-index: 0;
}

.service-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(13, 13, 18, 0.4) 0%, rgba(13, 13, 18, 0.92) 100%);
  z-index: 1;
}

.service-hero {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 660px;
  margin-bottom: 80px;
}

.service-badge {
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

.service-title {
  font-size: 3.5em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.15;
  margin-bottom: 24px;
  letter-spacing: -1.5px;
}

.service-desc {
  font-size: 1.05em;
  color: #a1a1aa;
  line-height: 1.8;
  max-width: 540px;
  margin: 0 auto;
}

.services-grid {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1140px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.service-card {
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

.service-card-active {
  border-color: rgba(167, 139, 250, 0.3) !important;
  box-shadow:
    0 20px 60px rgba(0, 0, 0, 0.5),
    0 0 40px rgba(167, 139, 250, 0.08),
    inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
  transform: translateY(-6px);
}

.service-card-image {
  position: relative;
  width: 100%;
  height: 180px;
  overflow: hidden;
}

.service-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.service-card:hover .service-card-image img {
  transform: scale(1.1);
}

.service-card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 0%, transparent 60%);
}

.service-card-body {
  padding: 20px 22px 24px;
}

.service-card-icon {
  font-size: 1.8em;
  margin-bottom: 12px;
}

.service-card-title {
  font-size: 1.15em;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 8px;
  letter-spacing: 0.3px;
}

.service-card-desc {
  font-size: 0.85em;
  color: #a1a1aa;
  line-height: 1.7;
}

@media (max-width: 900px) {
  .service-page {
    padding: 100px 16px 60px;
  }

  .service-title {
    font-size: 2.4em;
  }

  .service-hero {
    margin-bottom: 60px;
  }

  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .service-title {
    font-size: 1.8em;
  }

  .services-grid {
    grid-template-columns: 1fr;
    max-width: 400px;
    margin: 0 auto;
  }

  .service-card-image {
    height: 160px;
  }
}
</style>
