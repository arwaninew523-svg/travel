<script setup lang="ts">

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="min-h-svh w-full">
        <slot />
    </div>
</template>
