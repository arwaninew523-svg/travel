<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Upload, X } from '@lucide/vue';

const previewUrl = ref<string | null>(null);

const props = defineProps<{
    services: Array<{ id: number; name: string; type: string }>;
}>();

const form = useForm({
    title: '',
    location: '',
    short_description: '',
    price: '',
    duration_days: 1,
    duration_nights: 0,
    max_capacity: 1,
    is_active: true,
    thumbnail: null as File | null,
    services: [] as number[], // Menyimpan Array ID Service yang dicentang
});

const handleImageUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.thumbnail = file;
        previewUrl.value = URL.createObjectURL(file);
    }
};

const removeImage = () => {
    form.thumbnail = null;
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
        previewUrl.value = null;
    }
};

const submit = () => {
    form.post('/admin/packages');
};
</script>

<template>
    <Head title="Tambah Paket Wisata" />

    <div class="mx-auto max-w-4xl flex flex-col space-y-6 p-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <Link
                    href="/admin/packages"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-input bg-background text-sm font-medium shadow-sm hover:bg-accent hover:text-accent-foreground"
                >
                    <ArrowLeft class="h-4 w-4" />
                </Link>
                <div>
                    <h2 class="text-xl font-bold tracking-tight">Tambah Paket Wisata</h2>
                    <p class="text-sm text-muted-foreground">Buat paket tur baru untuk ditampilkan ke pelanggan</p>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit" class="space-y-6 rounded-lg border bg-card p-6 shadow-sm">
            <!-- Thumbnail Upload -->
            <div class="space-y-2">
                <label class="text-sm font-medium leading-none">Foto Thumbnail</label>
                
                <div v-if="previewUrl" class="relative w-full max-w-xs overflow-hidden rounded-md border border-input">
                    <img :src="previewUrl" alt="Preview" class="h-40 w-full object-cover" />
                    <button
                        type="button"
                        @click="removeImage"
                        class="absolute right-2 top-2 rounded-full bg-destructive p-1 text-destructive-foreground shadow hover:bg-destructive/90"
                    >
                        <X class="h-4 w-4" />
                    </button>
                </div>

                <div v-else class="flex items-center justify-center w-full">
                    <label
                        for="thumbnail"
                        class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-input rounded-lg cursor-pointer bg-transparent hover:bg-accent/50 transition-colors"
                        :class="{ 'border-destructive': form.errors.thumbnail }"
                    >
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <Upload class="w-8 h-8 mb-2 text-muted-foreground" />
                            <p class="mb-1 text-sm text-muted-foreground"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                            <p class="text-xs text-muted-foreground">PNG, JPG, WEBP (Max. 2MB)</p>
                        </div>
                        <input
                            id="thumbnail"
                            type="file"
                            accept="image/*"
                            class="hidden"
                            @change="handleImageUpload"
                        />
                    </label>
                </div>
                <span v-if="form.errors.thumbnail" class="text-xs text-destructive">{{ form.errors.thumbnail }}</span>
            </div>

            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="text-sm font-medium leading-none">Nama Paket</label>
                <input
                    id="title"
                    type="text"
                    v-model="form.title"
                    placeholder="Contoh: Bromo Adventure"
                    class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    :class="{ 'border-destructive': form.errors.title }"
                />
                <span v-if="form.errors.title" class="text-xs text-destructive">{{ form.errors.title }}</span>
            </div>

            <!-- Location & Price -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="location" class="text-sm font-medium leading-none">Lokasi Destinasi</label>
                    <input
                        id="location"
                        type="text"
                        v-model="form.location"
                        placeholder="Contoh: Jawa Timur"
                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                        :class="{ 'border-destructive': form.errors.location }"
                    />
                    <span v-if="form.errors.location" class="text-xs text-destructive">{{ form.errors.location }}</span>
                </div>

            </div>

            <!-- Duration & Capacity -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="space-y-2">
                    <label for="duration_days" class="text-sm font-medium leading-none">Durasi (Hari)</label>
                    <input
                        id="duration_days"
                        type="number"
                        v-model="form.duration_days"
                        min="1"
                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                </div>

                <div class="space-y-2">
                    <label for="duration_nights" class="text-sm font-medium leading-none">Durasi (Malam)</label>
                    <input
                        id="duration_nights"
                        type="number"
                        v-model="form.duration_nights"
                        min="0"
                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                </div>

                <div class="space-y-2">
                    <label for="max_capacity" class="text-sm font-medium leading-none">Kapasitas Maksimal (Orang)</label>
                    <input
                        id="max_capacity"
                        type="number"
                        v-model="form.max_capacity"
                        min="1"
                        class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    />
                </div>
            </div>

            <!-- Tambahkan Pilihan Checkbox Service di Form -->
            <div class="space-y-3 border-t pt-4">
                <label class="text-sm font-medium leading-none">Fasilitas & Service Paket</label>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div 
                        v-for="service in services" 
                        :key="service.id"
                        class="flex items-center space-x-2 border p-3 rounded-lg bg-card"
                    >
                        <input 
                            type="checkbox" 
                            :id="`service-${service.id}`"
                            :value="service.id" 
                            v-model="form.services"
                            class="h-4 w-4 rounded border-input"
                        />
                        <label :for="`service-${service.id}`" class="text-sm font-medium cursor-pointer flex items-center justify-between w-full">
                            <span>{{ service.name }}</span>
                            <span 
                                class="text-[10px] px-2 py-0.5 rounded uppercase font-bold"
                                :class="service.type === 'include' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500'"
                            >
                                {{ service.type }}
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Tambahkan Pilihan Checkbox Service di Form -->

            <!-- Description -->
            <div class="space-y-2">
                <label for="short_description" class="text-sm font-medium leading-none">Deskripsi Singkat</label>
                <textarea
                    id="short_description"
                    v-model="form.short_description"
                    rows="3"
                    placeholder="Saksikan matahari terbit ikonik di Gunung Bromo dan jelajahi lautan pasir."
                    class="flex min-h-[80px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                    :class="{ 'border-destructive': form.errors.short_description }"
                ></textarea>
                <span v-if="form.errors.short_description" class="text-xs text-destructive">{{ form.errors.short_description }}</span>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 border-t pt-4">
                <Link
                    href="/admin/packages"
                    class="inline-flex h-9 items-center justify-center rounded-md border border-input bg-background px-4 py-2 text-sm font-medium shadow-sm hover:bg-accent hover:text-accent-foreground"
                >
                    Batal
                </Link>
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90 disabled:opacity-50"
                >
                    {{ form.processing ? 'Menyimpan...' : 'Simpan Paket' }}
                </button>
            </div>
        </form>
    </div>
</template>