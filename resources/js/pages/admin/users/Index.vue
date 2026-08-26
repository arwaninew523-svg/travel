<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
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
import { useInitials } from '@/composables/useInitials';
import { create, destroy, edit, index } from '@/routes/admin/users';
import type { AdminUser, UserRole } from '@/types';

type Props = {
    users: AdminUser[];
};

defineProps<Props>();

const { getInitials } = useInitials();

const deleteDialogOpen = ref(false);
const userToDelete = ref<AdminUser | null>(null);

const roleBadgeVariant: Record<UserRole, 'default' | 'secondary' | 'outline'> =
    {
        admin: 'default',
        operator: 'secondary',
        user: 'outline',
    };

const roleLabel: Record<UserRole, string> = {
    admin: 'Admin',
    operator: 'Operator',
    user: 'User',
};

const permissionLabels: {
    key: 'can_view' | 'can_create' | 'can_edit' | 'can_delete';
    label: string;
}[] = [
    { key: 'can_view', label: 'Lihat' },
    { key: 'can_create', label: 'Tambah' },
    { key: 'can_edit', label: 'Edit' },
    { key: 'can_delete', label: 'Hapus' },
];

const confirmDelete = (user: AdminUser) => {
    userToDelete.value = user;
    deleteDialogOpen.value = true;
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Manajemen Pengguna',
                href: index(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Manajemen Pengguna" />

    <div class="flex flex-col space-y-6">
        <div class="flex items-center justify-between">
            <Heading
                variant="small"
                title="Manajemen Pengguna"
                description="Kelola akun pengguna dan hak akses mereka"
            />

            <Button as-child>
                <Link :href="create()"> <Plus /> Tambah Pengguna </Link>
            </Button>
        </div>

        <div class="space-y-3">
            <div
                v-for="user in users"
                :key="user.id"
                class="flex items-center justify-between gap-4 rounded-lg border p-4"
            >
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-muted text-sm font-medium"
                    >
                        {{ getInitials(user.name) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-medium">{{ user.name }}</span>
                            <Badge :variant="roleBadgeVariant[user.role]">
                                {{ roleLabel[user.role] }}
                            </Badge>
                        </div>
                        <div class="text-sm text-muted-foreground">
                            {{ user.email }}
                        </div>
                        <div class="mt-1 flex flex-wrap gap-1">
                            <Badge
                                v-for="permission in permissionLabels"
                                :key="permission.key"
                                variant="outline"
                            >
                                <span
                                    :class="
                                        user[permission.key]
                                            ? 'text-green-600 dark:text-green-400'
                                            : 'text-muted-foreground line-through'
                                    "
                                >
                                    {{ permission.label }}
                                </span>
                            </Badge>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <TooltipProvider>
                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button variant="ghost" size="sm" as-child>
                                    <Link :href="edit(user.id)">
                                        <Pencil class="h-4 w-4" />
                                    </Link>
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                                <p>Edit pengguna</p>
                            </TooltipContent>
                        </Tooltip>

                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button
                                    variant="ghost"
                                    size="sm"
                                    @click="confirmDelete(user)"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                                <p>Hapus pengguna</p>
                            </TooltipContent>
                        </Tooltip>
                    </TooltipProvider>
                </div>
            </div>

            <p
                v-if="users.length === 0"
                class="py-8 text-center text-muted-foreground"
            >
                Belum ada pengguna terdaftar.
            </p>
        </div>
    </div>

    <Dialog :open="deleteDialogOpen" @update:open="deleteDialogOpen = $event">
        <DialogContent>
            <Form
                v-if="userToDelete"
                v-bind="destroy.form(userToDelete.id)"
                v-slot="{ processing }"
            >
                <DialogHeader>
                    <DialogTitle>Hapus pengguna</DialogTitle>
                    <DialogDescription>
                        Apakah Anda yakin ingin menghapus "{{
                            userToDelete.name
                        }}"? Tindakan ini tidak dapat dibatalkan.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter class="gap-2">
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
