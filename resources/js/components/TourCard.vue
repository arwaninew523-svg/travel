<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Clock, Users } from '@lucide/vue';
import type { TourPackage } from '@/types';

defineProps<{
    package: TourPackage;
}>();

const formatRupiah = (val: number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(val);
};
</script>

<template>
    <div class="group relative overflow-hidden rounded-2xl bg-[#12131a] text-white shadow-xl transition-all duration-300 hover:-translate-y-1.5 border border-white/10 hover:border-purple-500/40 hover:shadow-purple-500/10">
        <!-- Image & Badge Container (Tetap ramping: h-44) -->
        <div class="relative h-44 w-full overflow-hidden bg-[#0d0d12]">
            <img
                :src="package.thumbnail || 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?q=80&w=800&auto=format&fit=crop'"
                :alt="package.title"
                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            />
            
            <!-- Gradient Overlay ala Destinasi -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#12131a] via-transparent to-transparent opacity-80 pointer-events-none"></div>

            <!-- Badge Durasi Atas -->
            <div class="absolute top-3 left-3 rounded-full bg-black/60 px-3 py-1 text-[11px] font-medium backdrop-blur-md border border-white/10">
                {{ package.duration_days }}H {{ package.duration_nights }}M
            </div>

            <!-- Price Tag -->
            <div class="absolute bottom-3 right-3 rounded-xl bg-black/75 px-3 py-1.5 backdrop-blur-md border border-white/10">
                <span class="text-[10px] font-light text-slate-300">Mulai </span>
                <span class="text-sm font-bold text-white">{{ formatRupiah(package.price) }}</span>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-5">
            <span class="text-[11px] font-bold uppercase tracking-widest text-purple-400">
                {{ package.location }}
            </span>

            <h3 class="mt-1 text-lg font-bold text-white line-clamp-1 group-hover:text-purple-300 transition-colors">
                {{ package.title }}
            </h3>

            <p class="mt-1.5 text-xs text-slate-400 line-clamp-2 leading-relaxed">
                {{ package.short_description }}
            </p>

            <!-- Metadata Icons -->
            <div class="mt-4 flex items-center gap-4 text-xs font-medium text-slate-300 border-t border-white/5 pt-3">
                <div class="flex items-center gap-1.5">
                    <Clock class="h-3.5 w-3.5 text-purple-400" />
                    <span>{{ package.duration_days }}H {{ package.duration_nights }}M</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <Users class="h-3.5 w-3.5 text-purple-400" />
                    <span>Max {{ package.max_capacity }} Org</span>
                </div>
            </div>

            <!-- Action Button -->
            <Link
                :href="`/packages/${package.slug}`"
                class="mt-4 block w-full rounded-xl border border-white/10 bg-white/5 py-2.5 text-center text-xs font-semibold text-white transition-all hover:bg-purple-600 hover:border-purple-600 shadow-sm"
            >
                Lihat Detail Paket
            </Link>
        </div>
    </div>
</template>