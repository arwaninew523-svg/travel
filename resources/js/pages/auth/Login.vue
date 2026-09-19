<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { store } from '@/routes/login';
</script>

<template>
    <Head title="Log in" />

    <div class="flex min-h-screen">
        <!-- Kiri: Background Alam -->
        <div class="relative hidden w-1/2 items-center justify-center overflow-hidden lg:flex">
            <img src="https://unsplash.com/id/foto/pohon-hijau-di-lapangan-coklat-di-bawah-langit-biru-di-siang-hari-xX3T2C8ff1o" alt="Mountain scenery" class="absolute inset-0 h-full w-full object-cover"/>
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/80 via-teal-800/70 to-cyan-900/80"></div>
            <div class="relative z-10 px-12 text-center">
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full border border-white/20 bg-white/10 backdrop-blur-sm">
                    <svg
                        width="40"
                        height="40"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="white"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </div>
                <h1 class="mb-4 text-4xl font-bold text-white">
                    Indonesia Culture Trip
                </h1>
                <p class="text-lg text-emerald-100/80">
                    Explore the natural beauty of Indonesia with us
                </p>
            </div>
        </div>

        <!-- Kanan: Form Login -->
        <div
            class="flex w-full items-center justify-center bg-white py-12 pl-8 pr-6 lg:w-1/2 lg:pl-16 lg:pr-10"
        >
            <div class="w-full max-w-md">
                <div class="mb-8 text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Welcome to website </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Enter the homepage to manage your website
                    </p>
                </div>

                <Form
                    :action="store.url()"
                    method="post"
                    :reset-on-success="['password']"
                    v-slot="{ errors, processing }"
                    class="flex flex-col gap-5"
                >
                    <div class="grid gap-2">
                        <Label for="email" class="text-sm font-medium text-gray-700">
                            Username
                        </Label>

                        <Input
                            id="email"
                            type="text"
                            name="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="username"
                            placeholder="Masukkan username"
                            class="h-11 border-gray-300 focus-visible:ring-emerald-500"
                        />

                        <InputError :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password" class="text-sm font-medium text-gray-700">
                            Password
                        </Label>

                        <PasswordInput
                            id="password"
                            name="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="h-11 border-gray-300 focus-visible:ring-emerald-500"
                        />

                        <InputError :message="errors.password" />
                    </div>

                    <Button
                        type="submit"
                        class="mt-2 h-11 w-full bg-emerald-600 text-white hover:bg-emerald-700"
                        :tabindex="3"
                        :disabled="processing"
                        data-test="login-button"
                    >
                        {{ processing ? 'Masuk...' : 'Masuk' }}
                    </Button>
                </Form>

                <p class="mt-8 text-left text-xs text-gray-400">
                    &copy; {{ new Date().getFullYear() }} Ijen Bromo Travel
                </p>
            </div>
        </div>
    </div>
</template>
