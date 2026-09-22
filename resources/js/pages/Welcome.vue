<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Destinations from '@/landing/components/Destinations.vue';
import LandingHero from '@/landing/components/Landing.vue';
import Packages from '@/landing/components/Packages.vue';
import Testimonial from '@/landing/components/Testimonial.vue';
import WhyTravelWithUs from '@/landing/components/WhyTravelWithUs.vue';
import type { TourPackage } from '@/types';

defineProps<{
    packages: TourPackage[];
}>();
</script>

<template>
    <Head title="Indonesia Culture Trip" />

    <LandingHero />
    <Destinations />
    <WhyTravelWithUs />
    <Packages :packages="packages" />
    <Testimonial />
</template>