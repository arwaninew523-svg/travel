<template>
  <section class="destinations">
    <div class="container">
      <h2 class="section-title">Best Destination</h2>
      <p class="section-subtitle">Discover the beauty of thousands of islands</p>

      <div class="list">
        <div v-for="(item, index) in items" :key="index" class="item">
          <img :src="item.image" :alt="item.name" loading="lazy">
          <div class="info">
            <h3>{{ item.name }}</h3>
            <span>{{ item.location }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const items = [
  {
    image: 'https://images.unsplash.com/photo-1602057512587-76d5cc4b34e2?q=80',
    name: 'Tugu Jogja',
    location: 'Yogyakarta'
  },
  {
    image: 'https://images.unsplash.com/photo-1615104168825-3d6391ccc228?q=80&w=870&',
    name: 'Tumpak Sewu',
    location: 'Lumajang'
  },
  {
    image: 'https://images.unsplash.com/photo-1575242385452-44b445d98f34?q=80&w=870&',
    name: 'Ijen',
    location: 'Banyuwangi'
  },
  {
    image: 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=600&q=80',
    name: 'Bromo',
    location: 'East Java'
  }
]
</script>

<style scoped>
.destinations {
  position: relative;
  padding: 100px 20px;
  background: #0d0d12;
  overflow: hidden;
}

.container {
  position: relative;
  z-index: 1;
  max-width: 900px;
  margin: 0 auto;
}

.section-title {
  text-align: center;
  font-size: 2.5em;
  color: #ffffff;
  margin-bottom: 8px;
}

.section-subtitle {
  text-align: center;
  font-size: 1.1em;
  color: #9ca3af;
  margin-bottom: 50px;
}

.list {
  display: flex;
  flex-direction: row;
  gap: 0;
  border-radius: 12px;
  overflow: hidden;
}

.item {
  position: relative;
  flex: 1;
  height: 450px;
  overflow: hidden;
  cursor: pointer;
  transition: flex 0.5s ease, filter 0.4s ease, z-index 0s;
  z-index: 1;
}

.list:hover .item {
  flex: 0.4;
}

.list .item:hover {
  flex: 2.8;
  z-index: 10;
  filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.6));
}

.item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: filter 0.4s ease;
}

.list:hover .item img {
  filter: brightness(0.5);
}

.list .item:hover img {
  filter: brightness(1);
}

.item::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 50%;
  background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
  pointer-events: none;
}

.info {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 30px;
  z-index: 2;
  transition: opacity 0.3s ease;
}

.list:hover .item:not(:hover) .info {
  opacity: 0;
}

.info h3 {
  font-size: 1.6em;
  color: #ffffff;
  margin: 0 0 4px;
  font-weight: 500;
}

.info span {
  font-size: 0.85em;
  color: #d1d5db;
  letter-spacing: 1px;
  text-transform: uppercase;
}

@media (max-width: 900px) {
  .list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    border-radius: 0;
    overflow: visible;
  }

  .item {
    border-radius: 12px;
    height: 300px;
    flex: none;
    filter: none;
  }

  .item img {
    filter: brightness(1);
  }

  .list:hover .item,
  .list .item:hover {
    flex: none;
    filter: none;
  }

  .list:hover .item img,
  .list .item:hover img {
    filter: brightness(1);
  }

  .item:hover img {
    transform: scale(1.05);
  }

  .list:hover .item:not(:hover) .info {
    opacity: 1;
  }
}

@media (max-width: 640px) {
  .destinations {
    padding: 50px 16px;
  }

  .section-title {
    font-size: 1.8em;
  }

  .list {
    grid-template-columns: 1fr;
    gap: 14px;
  }

  .item {
    height: 250px;
  }
}
</style>
