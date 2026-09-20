<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    demandes: App.Domain.Intervention.Dto.DemandeTravauxResumeDto[];
}>();
</script>

<template>
    <Head title="Mes demandes de travaux" />

    <h1 class="text-2xl font-semibold">Mes demandes de travaux</h1>

    <p v-if="demandes.length === 0" class="text-gray-500">
        Vous n'avez encore envoyé aucune demande.
    </p>

    <ul v-else class="divide-y">
        <li
            v-for="demande in demandes"
            :key="demande.id"
            class="flex items-center justify-between py-3"
        >
            <div>
                <span class="font-medium">{{ demande.titre }}</span>
                <span class="ml-2 text-sm text-gray-500"
                    >envoyée le {{ demande.soumiseLe }}</span
                >
            </div>
            <span class="rounded-full bg-gray-100 px-3 py-1 text-sm">{{
                demande.statut
            }}</span>
        </li>
    </ul>
</template>
