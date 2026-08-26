<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ShieldCheck, UserRound, Users, BriefcaseBusiness } from '@lucide/vue';
import Heading from '@/components/Heading.vue';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dashboard } from '@/routes/admin';
import type { AdminStats, AdminUser, UserRole } from '@/types';

type Props = {
    stats: AdminStats;
    recentUsers: AdminUser[];
};

defineProps<Props>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard Admin',
                href: dashboard(),
            },
        ],
    },
});

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

const statCards: {
    label: string;
    key: keyof AdminStats;
    icon: typeof Users;
}[] = [
    {
        label: 'Total Pengguna',
        key: 'totalUsers',
        icon: Users,
    },
    {
        label: 'Admin',
        key: 'admins',
        icon: ShieldCheck,
    },
    {
        label: 'Operator',
        key: 'operators',
        icon: BriefcaseBusiness,
    },
    {
        label: 'User',
        key: 'regularUsers',
        icon: UserRound,
    },
];
</script>

<template>
    <Head title="Dashboard Admin" />

    <div class="flex flex-col space-y-6">
        <Heading
            variant="small"
            title="Dashboard Admin"
            description="Ringkasan pengguna yang terdaftar di aplikasi"
        />

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <Card v-for="card in statCards" :key="card.label">
                <CardHeader
                    class="flex flex-row items-center justify-between space-y-0 pb-2"
                >
                    <CardTitle
                        class="text-sm font-medium text-muted-foreground"
                    >
                        {{ card.label }}
                    </CardTitle>
                    <component
                        :is="card.icon"
                        class="h-4 w-4 text-muted-foreground"
                    />
                </CardHeader>
                <CardContent>
                    <div class="text-2xl font-bold">{{ stats[card.key] }}</div>
                </CardContent>
            </Card>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>Pengguna Terbaru</CardTitle>
                <CardDescription>
                    Lima pengguna terakhir yang bergabung
                </CardDescription>
            </CardHeader>
            <CardContent>
                <ul class="space-y-3">
                    <li
                        v-for="user in recentUsers"
                        :key="user.id"
                        class="flex items-center justify-between gap-4 rounded-lg border p-4"
                    >
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-muted text-sm font-medium"
                            >
                                {{ user.name.charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <div class="font-medium">{{ user.name }}</div>
                                <div class="text-sm text-muted-foreground">
                                    {{ user.email }}
                                </div>
                            </div>
                        </div>
                        <Badge
    :class="{
        'bg-green-100 text-green-700 border-green-200 hover:bg-green-100': user.role === 'admin',
        'bg-blue-100 text-blue-700 border-blue-200 hover:bg-blue-100': user.role === 'operator',
        'bg-yellow-100 text-yellow-700 border-yellow-200 hover:bg-yellow-100': user.role === 'user',
    }"
    variant="outline"
>
    {{ roleLabel[user.role] }}
</Badge>
                    </li>
                </ul>

                <p
                    v-if="recentUsers.length === 0"
                    class="py-8 text-center text-muted-foreground"
                >
                    Belum ada pengguna terdaftar.
                </p>
            </CardContent>
        </Card>
    </div>
</template>
