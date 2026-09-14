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

    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-emerald-100 via-emerald-50 to-teal-100 px-4">
        <div class="w-full max-w-lg rounded-3xl border-2 border-emerald-200 bg-white p-10 shadow-[0_20px_50px_-12px_rgba(16,185,129,0.25)]">
            <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <svg
                    width="26"
                    height="26"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
            </div>

            <h1 class="mb-1 text-center text-2xl font-extrabold text-emerald-900">
                Welcome to Website
            </h1>
            <p class="mb-7 text-center text-sm text-slate-500">
                Masukkan username dan password Anda.
            </p>

            <Form
                :action="store.url()"
                method="post"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-5"
            >
                <div class="grid gap-2">
                    <Label for="email" class="text-slate-700">Username</Label>
                    <Input
                        id="email"
                        type="text"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="username"
                        placeholder="Username"
                        class="!border-emerald-200 !focus-visible:ring-emerald-500"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password" class="text-slate-700"
                        >Password</Label
                    >
                    <PasswordInput
                        id="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                        class="!border-emerald-200 !focus-visible:ring-emerald-500"
                    />
                    <InputError :message="errors.password" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full !bg-emerald-600 !text-white hover:!bg-emerald-700"
                    :tabindex="3"
                    :disabled="processing"
                    data-test="login-button"
                >
                    Log in
                </Button>
            </Form>
        </div>
    </div>
</template>
