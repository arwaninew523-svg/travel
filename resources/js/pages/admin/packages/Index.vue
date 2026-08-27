<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
// import { Pencil, Plus, Trash2, MapPin, Clock, Users } from 'lucide-react-vue3';
import { MapPin, Clock, Users, Pencil, Plus, Trash2 } from '@lucide/vue';
import { ref } from 'vue';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/components/ui/tooltip';
import { index, create, edit, destroy } from '@/routes/admin/packages';
import type { TourPackage } from '@/types';

type Props = {
    packages: TourPackage[];
};

defineProps<Props>();

const deleteDialogOpen = ref(false);
const packageToDelete = ref<TourPackage | null>(null);

const confirmDelete = (pkg: TourPackage) => {
    packageToDelete.value = pkg;
    deleteDialogOpen.value = true;
};

const formatRupiah = (val: number) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(val);
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Manajemen Paket Wisata',
                href: index(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Manajemen Paket Wisata" />

    <div class="flex flex-col space-y-6 p-8">
        <div class="flex items-center justify-between">
            <Heading
                variant="small"
                title="Manajemen Paket Wisata"
                description="Kelola daftar paket tour dan destinasi UMKM"
            />

            <Button as-child>
                <Link :href="create()"> <Plus class="mr-1 h-4 w-4" /> Tambah Paket </Link>
            </Button>
        </div>

        <div class="space-y-3">
            <div
                v-for="item in packages"
                :key="item.id"
                class="flex items-center justify-between gap-4 rounded-lg border p-4"
            >
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-muted text-sm font-medium overflow-hidden"
                    >
                        <img v-if="item.thumbnail" :src="item.thumbnail" :alt="item.title" class="h-full w-full object-cover" />
                        <MapPin v-else class="h-5 w-5 text-muted-foreground" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-medium text-base">{{ item.title }}</span>
                            <Badge :variant="item.is_active ? 'default' : 'secondary'">
                                {{ item.is_active ? 'Aktif' : 'Draft' }}
                            </Badge>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-muted-foreground mt-1">
                            <span class="flex items-center gap-1"><MapPin class="h-3 w-3" /> {{ item.location }}</span>
                            <span class="flex items-center gap-1"><Clock class="h-3 w-3" /> {{ item.duration_days }}H {{ item.duration_nights }}M</span>
                            <span class="flex items-center gap-1"><Users class="h-3 w-3" /> Max {{ item.max_capacity }} pax</span>
                        </div>
                        <div class="mt-1 font-semibold text-sm text-primary">
                            {{ formatRupiah(item.price) }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <TooltipProvider>
                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button variant="ghost" size="sm" as-child>
                                    <Link :href="edit(item.id)">
                                        <Pencil class="h-4 w-4" />
                                    </Link>
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                                <p>Edit paket</p>
                            </TooltipContent>
                        </Tooltip>

                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button
                                    variant="ghost"
                                    size="sm"
                                    @click="confirmDelete(item)"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                                <p>Hapus paket</p>
                            </TooltipContent>
                        </Tooltip>
                    </TooltipProvider>
                </div>
            </div>

            <p
                v-if="packages.length === 0"
                class="py-8 text-center text-muted-foreground"
            >
                Belum ada paket wisata terdaftar.
            </p>
        </div>
    </div>

    <Dialog :open="deleteDialogOpen" @update:open="deleteDialogOpen = $event">
        <DialogContent>
            <Form
                v-if="packageToDelete"
                v-bind="destroy.form(packageToDelete.id)"
                v-slot="{ processing }"
            >
                <DialogHeader>
                    <DialogTitle>Hapus Paket Wisata</DialogTitle>
                    <DialogDescription>
                        Apakah Anda yakin ingin menghapus paket "{{ packageToDelete.title }}"? Tindakan ini tidak dapat dibatalkan.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter class="gap-2 mt-4">
                    <DialogClose as-child>
                        <Button variant="secondary"> Batal </Button>
                    </DialogClose>

                    <Button
                        type="submit"
                        variant="destructive"
                        :disabled="processing"
                    >
                        Hapus
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>