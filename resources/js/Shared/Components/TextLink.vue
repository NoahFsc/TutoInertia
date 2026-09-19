<script setup lang="ts">
import type { LinkComponentBaseProps, Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: LinkComponentBaseProps['href'];
    method?: Method;
    as?: string;
}>();
</script>

<template>
    <Link
        :href="href"
        :method="method"
        :as="as"
        class="text-gray-900 underline decoration-gray-300 underline-offset-4 transition-colors hover:decoration-gray-900"
    >
        <slot />
    </Link>
</template>
