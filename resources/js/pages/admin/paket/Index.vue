<script>
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card' 
import { Head } from '@inertiajs/vue3'
</script>

<template>
    <Head title="paket">
        <div class="flex flex-1 items-start justify-start bg-gradient-to-br from-chart-2/10 via-background to-chart-5/10 p-6">
            <Card class="w-full max-w-7xl">
            <CardHeader class="pb-4">
                <CardTitle class="text-3xl font-bold">
                    Selamat Datang di Dashboard Admin
                </CardTitle>

                <CardDescription class="mt-2 text-base">
                    Kelola seluruh data dan aktivitas website anda melalui dashboard ini.
                </CardDescription>
            </CardHeader>

        </Card>
        </div>
    </Head>
</template>