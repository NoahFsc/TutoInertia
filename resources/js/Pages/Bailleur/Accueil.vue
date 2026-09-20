<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Espace bailleur" />
    <h1 class="text-2xl font-semibold">
        Bonjour {{ $page.props.auth.user?.name }}
    </h1>
    <p class="text-gray-600">Espace bailleur.</p>
</template>
