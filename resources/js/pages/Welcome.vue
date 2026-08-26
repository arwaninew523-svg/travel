<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Destinations from '@/landing/components/Destinations.vue';
import LandingHero from '@/landing/components/Landing.vue';
import Pricing from '@/landing/components/Pricing.vue';
import Testimonial from '@/landing/components/Testimonial.vue';
</script>

<template>
    <Head title="Ijen Bromo Travel - Explore Indonesia" />

    <LandingHero />
    <Destinations />
    <Pricing />
    <Testimonial />
</template>
