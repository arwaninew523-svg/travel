<template>
  <header :class="{ 'scrolled': scrolled }">
    <h2 class="logo">Ijen <span>Bromo</span> Travel</h2>
    <nav :class="['navigation', { 'open': menuOpen }]">
      <Link href="/" :class="{ active: $page.url === '/' }">Home</Link>
      <Link href="/about" :class="{ active: $page.url.startsWith('/about') }">About</Link>
      <Link href="/service" :class="{ active: $page.url.startsWith('/service') }">Service</Link>
      <Link href="/contact" :class="{ active: $page.url.startsWith('/contact') }">Contact</Link>
    </nav>
    <button class="menu-toggle" @click="menuOpen = !menuOpen" :class="{ 'open': menuOpen }">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from "vue";

const menuOpen = ref(false)
const scrolled = ref(false)
let handleScroll

onMounted(() => {
  handleScroll = () => {
    scrolled.value = window.scrollY > 50
  }
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
