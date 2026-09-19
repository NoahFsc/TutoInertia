<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10"
    >
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-3 text-center">
                    <Link
                        :href="home()"
                        class="text-lg font-semibold tracking-tight"
                    >
                        {{ $page.props.name }}
                    </Link>
                    <h1 class="text-xl font-medium">{{ title }}</h1>
                    <p v-if="description" class="text-sm text-gray-500">
                        {{ description }}
                    </p>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
