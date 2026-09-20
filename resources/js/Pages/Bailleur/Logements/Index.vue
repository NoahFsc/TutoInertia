<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    logements: Array<{
        id: number;
        adresse: string;
        loyer_cents: number;
        statut: string;
        demandes_travaux_count: number;
    }>;
}>();
</script>

<template>
    <Head title="Logements" />

    <h1 class="text-2xl font-semibold">Logements</h1>

    <ul class="divide-y">
        <li v-for="logement in logements" :key="logement.id" class="py-3">
            <span class="font-medium">{{ logement.adresse }}</span>
            <span class="ml-2 text-sm text-gray-500">
                {{ (logement.loyer_cents / 100).toFixed(2) }} € ·
                {{ logement.statut }} ·
                {{ logement.demandes_travaux_count }} demande(s)
            </span>
        </li>
    </ul>
</template>
