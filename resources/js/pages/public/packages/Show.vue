<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, MapPin, Clock, Users, CheckCircle2, XCircle, Send, Sparkles, CalendarDays, UserRound } from '@lucide/vue';

interface Service {
    id: number;
    name: string;
    type: 'include' | 'exclude';
}

interface TourPackage {
    id: number;
    title: string;
    slug: string;
    location: string;
    price: number;
    duration_days: number;
    duration_nights: number;
    max_capacity: number;
    short_description: string;
    description: string | null;
    thumbnail: string | null;
    services?: Service[];
}

const props = defineProps<{
    package: TourPackage;
    whatsappNumber: string;
}>();

const includedServices = computed(() => {
    return props.package.services?.filter((s) => s.type === 'include') || [];
});

const excludedServices = computed(() => {
    return props.package.services?.filter((s) => s.type === 'exclude') || [];
});

const customerName = ref('');
const travelDate = ref('');
const participantCount = ref(1);

const totalPrice = computed(() => {
    return props.package.price * participantCount.value;
});

const formatRupiah = (val: number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(val);
};

const sendToWhatsApp = () => {
    if (!customerName.value || !travelDate.value) {
        alert('Mohon isi nama dan tanggal keberangkatan.');
        return;
    }

    const message =
`Halo Admin, saya ingin memesan paket wisata berikut:

📌 *Paket:* ${props.package.title}
📍 *Lokasi:* ${props.package.location}
🗓️ *Tgl Keberangkatan:* ${travelDate.value}
👤 *Jumlah Peserta:* ${participantCount.value} Orang
💰 *Total Estimasi:* ${formatRupiah(totalPrice.value)}

*Data Pemesan:*
• *Nama:* ${customerName.value}

Mohon informasi ketersediaan slot dan langkah pembayaran selanjutnya. Terima kasih!`;

    const encodedMessage = encodeURIComponent(message);
    const waUrl = `https://wa.me/${props.whatsappNumber}?text=${encodedMessage}`;
    window.open(waUrl, '_blank');
};
</script>

<template>
    <Head :title="`${package.title} - Detail Paket`" />

    <div class="min-h-screen bg-slate-950 text-slate-100">
        <!-- Hero Banner Full Width -->
        <div class="relative h-[80vh] min-h-[560px] w-full overflow-hidden">
            <img
                :src="package.thumbnail || 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=1400&q=80'"
                :alt="package.title"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-slate-950"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-transparent"></div>

            <!-- Top Nav (overlaid, below navbar) -->
            <div class="absolute top-[86px] left-0 right-0 z-50 px-6">
                <div class="max-w-6xl mx-auto flex items-center justify-between">
                    <Link
                        href="/"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-xs font-medium text-white backdrop-blur-md hover:bg-white/20 transition-all"
                    >
                        <ArrowLeft class="w-3.5 h-3.5" /> Kembali
                    </Link>
                </div>
            </div>

            <!-- Title & Info at Bottom -->
            <div class="absolute bottom-0 left-0 right-0 z-10">
                <div class="max-w-6xl mx-auto px-6 pb-12">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-[11px] font-bold uppercase tracking-[3px] text-violet-300 bg-violet-500/15 px-3 py-1 rounded-full border border-violet-400/20 backdrop-blur-md">
                            {{ package.location }}
                        </span>
                        <span class="text-[11px] font-bold uppercase tracking-[3px] text-emerald-300 bg-emerald-500/15 px-3 py-1 rounded-full border border-emerald-400/20 backdrop-blur-md">
                            {{ package.duration_days }} Hari / {{ package.duration_nights }} Malam
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1]">
                        {{ package.title }}
                    </h1>
                </div>
                <div class="h-24 bg-gradient-to-t from-slate-950 to-transparent"></div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-6 -mt-6 relative z-20 grid grid-cols-1 lg:grid-cols-3 gap-8 pb-24">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Highlight Stats -->
                <div class="grid grid-cols-3 gap-4 p-5 rounded-2xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <Clock class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Durasi</p>
                            <p class="text-sm font-bold text-slate-100">{{ package.duration_days }}H {{ package.duration_nights }}M</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pl-4 border-l border-slate-800/80">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <Users class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Kapasitas</p>
                            <p class="text-sm font-bold text-slate-100">Max {{ package.max_capacity }} Orang</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pl-4 border-l border-slate-800/80">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <MapPin class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Destinasi</p>
                            <p class="text-sm font-bold text-slate-100 truncate">{{ package.location }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <Sparkles class="w-4 h-4 text-violet-400" /> Ringkasan Paket
                    </h3>
                    <p class="text-slate-300/90 leading-relaxed text-[15px] whitespace-pre-line bg-slate-900/40 p-6 rounded-2xl border border-slate-800/50">
                        {{ package.short_description }}
                    </p>
                </div>

                <!-- Deskripsi -->
                <div v-if="package.description" class="space-y-3">
                    <h3 class="text-lg font-bold text-white">Detail Perjalanan</h3>
                    <div class="text-slate-300/90 leading-relaxed text-[15px] whitespace-pre-line bg-slate-900/40 p-6 rounded-2xl border border-slate-800/50">
                        {{ package.description }}
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="space-y-5 pt-6 border-t border-slate-800/60">
                    <h3 class="text-lg font-bold text-white">Fasilitas & Layanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">Termasuk</h4>
                            <div v-if="includedServices.length > 0" class="space-y-2">
                                <div
                                    v-for="service in includedServices"
                                    :key="service.id"
                                    class="flex items-center gap-3 text-sm text-slate-200 bg-slate-900/50 p-3.5 rounded-xl border border-emerald-500/10"
                                >
                                    <CheckCircle2 class="w-4 h-4 text-emerald-400 shrink-0" />
                                    <span>{{ service.name }}</span>
                                </div>
                            </div>
                            <p v-else class="text-xs text-slate-500 italic py-3">Tidak ada rincian fasilitas.</p>
                        </div>
                        <div class="space-y-3">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-rose-400">Tidak Termasuk</h4>
                            <div v-if="excludedServices.length > 0" class="space-y-2">
                                <div
                                    v-for="service in excludedServices"
                                    :key="service.id"
                                    class="flex items-center gap-3 text-sm text-slate-400 bg-slate-900/30 p-3.5 rounded-xl border border-rose-500/10"
                                >
                                    <XCircle class="w-4 h-4 text-rose-400 shrink-0" />
                                    <span>{{ service.name }}</span>
                                </div>
                            </div>
                            <p v-else class="text-xs text-slate-500 italic py-3">Tidak ada rincian fasilitas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
