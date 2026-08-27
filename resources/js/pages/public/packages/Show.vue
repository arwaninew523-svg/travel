<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, MapPin, Clock, Users, CheckCircle2, XCircle, Send, Sparkles } from '@lucide/vue';

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

// Filter Services
const includedServices = computed(() => {
    return props.package.services?.filter((s) => s.type === 'include') || [];
});

const excludedServices = computed(() => {
    return props.package.services?.filter((s) => s.type === 'exclude') || [];
});

// Form Pemesanan Sederhana
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

// Generate Link WhatsApp dengan Pesan Terformat
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

    <div class="min-h-screen bg-slate-950 text-slate-100 pb-20 pt-20">
        <!-- Top Navigation Bar (Fixed / Clean Header) -->
        <div class="sticky top-0 z-50 w-full border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md px-6 py-4">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <Link 
                    href="/home" 
                    class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-medium text-slate-300 hover:text-white hover:border-slate-700 transition-all"
                >
                    <ArrowLeft class="w-3.5 h-3.5" /> Kembali ke Katalog
                </Link>
                <div class="text-xs font-semibold text-violet-400 bg-violet-500/10 px-3 py-1 rounded-full border border-violet-500/20">
                    {{ package.location }}
                </div>
            </div>
        </div>

        <!-- Hero Banner Header -->
        <div class="relative h-[45vh] min-h-[350px] w-full bg-slate-900 overflow-hidden">
            <img 
                :src="package.thumbnail || 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=1200&q=80'" 
                :alt="package.title"
                class="h-full w-full object-cover opacity-90"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>

            <div class="absolute bottom-8 left-0 right-0 max-w-6xl mx-auto px-6">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight mb-2">
                    {{ package.title }}
                </h1>
                <p class="text-slate-400 text-sm md:text-base flex items-center gap-2">
                    <MapPin class="w-4 h-4 text-violet-400" /> {{ package.location }}
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-6xl mx-auto px-6 mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Detail Information -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Highlight Badges -->
                <div class="grid grid-cols-3 gap-4 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80 backdrop-blur">
                    <div class="flex items-center gap-3 p-2">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <Clock class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 uppercase tracking-wider font-semibold">Durasi</p>
                            <p class="text-xs md:text-sm font-semibold text-slate-200">
                                {{ package.duration_days }}H {{ package.duration_nights }}M
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-2 border-x border-slate-800/80">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <Users class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 uppercase tracking-wider font-semibold">Kapasitas</p>
                            <p class="text-xs md:text-sm font-semibold text-slate-200">
                                Max {{ package.max_capacity }} Orang
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-2">
                        <div class="p-2.5 rounded-xl bg-violet-500/10 text-violet-400 border border-violet-500/20">
                            <MapPin class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 uppercase tracking-wider font-semibold">Destinasi</p>
                            <p class="text-xs md:text-sm font-semibold text-slate-200 truncate">
                                {{ package.location }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Paket -->
                <div class="space-y-3">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <Sparkles class="w-4 h-4 text-violet-400" /> Ringkasan Paket
                    </h3>
                    <p class="text-slate-300 leading-relaxed text-sm whitespace-pre-line bg-slate-900/40 p-5 rounded-2xl border border-slate-800/50">
                        {{ package.short_description }}
                    </p>
                </div>

                <!-- Deskripsi Lengkap (jika ada) -->
                <div v-if="package.description" class="space-y-3">
                    <h3 class="text-lg font-bold text-white">Detail Perjalanan</h3>
                    <div class="text-slate-300 leading-relaxed text-sm whitespace-pre-line bg-slate-900/40 p-5 rounded-2xl border border-slate-800/50">
                        {{ package.description }}
                    </div>
                </div>

                <!-- Dynamic Included & Excluded Services -->
                <div class="space-y-6 pt-4 border-t border-slate-800/80">
                    <h3 class="text-lg font-bold text-white">Fasilitas & Layanan</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Included -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-400">Termasuk (Included)</h4>
                            <div v-if="includedServices.length > 0" class="space-y-2">
                                <div 
                                    v-for="service in includedServices" 
                                    :key="service.id" 
                                    class="flex items-center gap-2.5 text-slate-300 text-sm bg-slate-900/60 p-3 rounded-xl border border-emerald-500/10"
                                >
                                    <CheckCircle2 class="w-4 h-4 text-emerald-400 shrink-0" />
                                    <span>{{ service.name }}</span>
                                </div>
                            </div>
                            <p v-else class="text-xs text-slate-500 italic">Tidak ada rincian fasilitas include.</p>
                        </div>

                        <!-- Excluded -->
                        <div class="space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-rose-400">Tidak Termasuk (Excluded)</h4>
                            <div v-if="excludedServices.length > 0" class="space-y-2">
                                <div 
                                    v-for="service in excludedServices" 
                                    :key="service.id" 
                                    class="flex items-center gap-2.5 text-slate-400 text-sm bg-slate-900/30 p-3 rounded-xl border border-rose-500/10"
                                >
                                    <XCircle class="w-4 h-4 text-rose-400 shrink-0" />
                                    <span>{{ service.name }}</span>
                                </div>
                            </div>
                            <p v-else class="text-xs text-slate-500 italic">Tidak ada rincian fasilitas excluded.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Form Pemesanan WhatsApp -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 p-6 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-6 shadow-2xl backdrop-blur">
                    <div class="border-b border-slate-800/80 pb-4">
                        <span class="text-xs text-slate-400 font-medium">Harga per pax</span>
                        <div class="text-3xl font-extrabold text-violet-400 mt-1">
                            {{ formatRupiah(package.price) }}
                        </div>
                    </div>

                    <form @submit.prevent="sendToWhatsApp" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Pemesan</label>
                            <input 
                                type="text" 
                                v-model="customerName"
                                placeholder="Masukkan nama lengkap" 
                                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-sm text-slate-100 placeholder:text-slate-600 focus:outline-none focus:border-violet-500 transition-colors"
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">Tanggal Keberangkatan</label>
                            <input 
                                type="date" 
                                v-model="travelDate"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-sm text-slate-100 focus:outline-none focus:border-violet-500 transition-colors"
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1.5">Jumlah Peserta (Orang)</label>
                            <input 
                                type="number" 
                                v-model="participantCount"
                                min="1" 
                                :max="package.max_capacity"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-sm text-slate-100 focus:outline-none focus:border-violet-500 transition-colors"
                                required
                            />
                        </div>

                        <div class="pt-4 border-t border-slate-800/80 space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total Estimasi</span>
                                <span class="text-violet-300 text-xl font-bold">{{ formatRupiah(totalPrice) }}</span>
                            </div>

                            <button 
                                type="submit" 
                                class="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm flex items-center justify-center gap-2 transition-all shadow-lg shadow-emerald-950/50 active:scale-[0.98]"
                            >
                                <Send class="w-4 h-4" /> Pesan via WhatsApp
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>