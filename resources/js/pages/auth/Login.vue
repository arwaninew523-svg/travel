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
        <div class="relative hidden w-2/3 items-center justify-center overflow-hidden lg:flex">
            <img
                src="/ijen.jpg"
                alt="Danau dekat pegunungan"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-emerald-900/50 to-teal-900/70"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-20 left-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
                <div class="absolute bottom-20 right-20 h-96 w-96 rounded-full bg-emerald-300/20 blur-3xl"></div>
            </div>

            <div class="relative z-10 px-16 text-left">
                <div class="mb-8 flex items-center gap-3">
                    <span class="text-xl font-semibold text-white">Indonesia Culture Trip</span>
                </div>

                <h1 class="mb-4 text-5xl font-bold leading-tight text-white">
                    Discover the Beauty of
                    <span class="block text-emerald-200">Nusantara</span>
                </h1>
                <p class="mb-8 max-w-md text-lg leading-relaxed text-emerald-100/80">
                    Explore the beauty of Indonesia's natural landscapes. Enjoy unforgettable journeys with us.
                </p>

            </div>
        </div>

        <div class="flex w-full items-center justify-center bg-gradient-to-br from-gray-50 to-white py-12 px-8 lg:w-1/3">
            <div class="w-full max-w-sm">
                <div class="mb-8 flex items-center gap-2 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">Indonesia Culture Trip</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl text-center font-bold text-gray-900">Sign In</h2>
                    <p class="mt-2 text-sm text-center text-gray-500">
                        Log in to manage your trip
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
                        <Label for="username" class="text-sm font-medium text-gray-700">
                            Username
                        </Label>
                        <div class="relative">
                            <Input
                                id="username"
                                type="text"
                                name="username"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="username"
                                placeholder="Masukkan username"
                                class="h-12 rounded-xl border-emerald-500 bg-white pl-10 focus-visible:border-emerald-500 focus-visible:ring-emerald-500"
                            />
                            <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <InputError :message="errors.username" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password" class="text-sm font-medium text-gray-700">
                            Password
                        </Label>
                        <div class="relative">
                            <PasswordInput
                                id="password"
                                name="password"
                                required
                                :tabindex="2"
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                class="h-12 rounded-xl border-gray-200 bg-gray-50 pl-10 focus-visible:ring-emerald-500 focus-visible:border-emerald-500"
                            />
                            <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <InputError :message="errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" />
                            Remember me
                        </label>
                        <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">
                            Forgot password?
                        </a>
                    </div>

                    <Button
                        type="submit"
                        class="mt-2 h-12 w-full rounded-xl bg-emerald-600 text-base font-semibold text-white shadow-lg shadow-emerald-500/30 transition-all hover:bg-emerald-700 hover:shadow-xl hover:shadow-emerald-500/40 active:scale-[0.98]"
                        :tabindex="3"
                        :disabled="processing"
                        data-test="login-button"
                    >
                        <svg v-if="processing" class="mr-2 h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ processing ? 'Signing in...' : 'Sign in' }}
                    </Button>
                </Form>


                <p class="mt-8 text-center text-xs text-gray-400">
                    &copy; {{ new Date().getFullYear() }} Indonesia Culture Trip. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</template>
