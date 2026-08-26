<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { ArrowLeft } from '@lucide/vue';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { edit, index, update } from '@/routes/admin/users';
import type { AdminRoleOption, AdminUser, UserRole } from '@/types';

type Props = {
    user: AdminUser;
    roles: AdminRoleOption[];
};

const props = defineProps<Props>();

const role = ref<UserRole>(props.user.role);

const permissions: {
    key: 'can_view' | 'can_create' | 'can_edit' | 'can_delete';
    label: string;
    description: string;
}[] = [
    { key: 'can_view', label: 'Lihat', description: 'Dapat melihat data' },
    { key: 'can_create', label: 'Tambah', description: 'Dapat menambah data' },
    { key: 'can_edit', label: 'Edit', description: 'Dapat mengubah data' },
    { key: 'can_delete', label: 'Hapus', description: 'Dapat menghapus data' },
];

defineOptions({
    layout: (props: { user: AdminUser }) => ({
        breadcrumbs: [
            {
                title: 'Manajemen Pengguna',
                href: index(),
            },
            {
                title: 'Edit Pengguna',
                href: edit(props.user.id),
            },
        ],
    }),
});
</script>

<template>
    <Head title="Edit Pengguna" />

    <div class="flex flex-col space-y-6">
        <div class="flex items-center justify-between">
            <Button variant="ghost" size="sm" as-child>
                <Link :href="index()">
                    <ArrowLeft class="h-4 w-4" /> Kembali
                </Link>
            </Button>
        </div>

        <Card class="mx-auto w-full max-w-2xl">
            <CardHeader>
                <CardTitle>Edit Pengguna</CardTitle>
                <CardDescription>
                    Perbarui data dan hak akses "{{ user.name }}".
                </CardDescription>
            </CardHeader>
            <CardContent>
                <Form
                    v-bind="update.form(user.id)"
                    class="space-y-6"
                    v-slot="{ errors, processing }"
                >
                    <div class="grid gap-2">
                        <Label for="name">Nama</Label>
                        <Input
                            id="name"
                            name="name"
                            :default-value="user.name"
                            required
                            autocomplete="name"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            name="email"
                            type="email"
                            :default-value="user.email"
                            required
                            autocomplete="username"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Kata Sandi Baru</Label>
                        <PasswordInput
                            id="password"
                            name="password"
                            autocomplete="new-password"
                            placeholder="Biarkan kosong jika tidak diubah"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation"
                            >Konfirmasi Kata Sandi Baru</Label
                        >
                        <PasswordInput
                            id="password_confirmation"
                            name="password_confirmation"
                            autocomplete="new-password"
                            placeholder="Ulangi kata sandi baru"
                        />
                    </div>

                    <div class="grid gap-2">
                        <Label for="role">Role</Label>
                        <Select v-model="role" name="role">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Pilih role" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem
                                    v-for="option in roles"
                                    :key="option.value"
                                    :value="option.value"
                                >
                                    {{ option.label }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError :message="errors.role" />
                    </div>

                    <div class="space-y-3">
                        <div>
                            <Label>Hak Akses</Label>
                            <p class="text-sm text-muted-foreground">
                                {{
                                    role === 'admin'
                                        ? 'Admin selalu memiliki semua hak akses.'
                                        : 'Atur hak akses untuk pengguna ini.'
                                }}
                            </p>
                        </div>

                        <div class="grid gap-2">
                            <Label
                                v-for="permission in permissions"
                                :key="permission.key"
                                :for="permission.key"
                                class="flex cursor-pointer items-center justify-between rounded-lg border p-4"
                                :class="role === 'admin' ? 'opacity-60' : ''"
                            >
                                <div>
                                    <span class="font-medium">
                                        {{ permission.label }}
                                    </span>
                                    <span
                                        class="ml-2 text-sm text-muted-foreground"
                                    >
                                        {{ permission.description }}
                                    </span>
                                </div>
                                <Checkbox
                                    :id="permission.key"
                                    :name="permission.key"
                                    :checked="
                                        role === 'admin'
                                            ? true
                                            : user[permission.key]
                                    "
                                    :disabled="role === 'admin'"
                                />
                            </Label>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button
                            type="submit"
                            data-test="update-user-button"
                            :disabled="processing"
                        >
                            Simpan
                        </Button>
                    </div>
                </Form>
            </CardContent>
        </Card>
    </div>
</template>
