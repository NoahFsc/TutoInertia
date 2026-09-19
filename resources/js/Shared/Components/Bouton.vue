<script setup lang="ts">
withDefaults(
    defineProps<{
        variante?: 'primaire' | 'secondaire';
        type?: 'button' | 'submit';
        disabled?: boolean;
    }>(),
    { variante: 'primaire', type: 'button', disabled: false },
);
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        class="inline-flex items-center justify-center gap-2 rounded-md px-4 py-2 text-sm font-medium transition-colors focus:ring-2 focus:ring-gray-900/30 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
        :class="
            variante === 'primaire'
                ? 'bg-gray-900 text-white hover:bg-gray-700'
                : 'border border-gray-300 bg-white text-gray-900 hover:bg-gray-100'
        "
    >
        <slot />
    </button>
</template>
