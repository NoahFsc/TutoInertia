<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

// Le type vient de generated.d.ts : un champ renommé dans le DTO casse la compilation ici.
defineProps<{
    demandes: App.Domain.Intervention.Dto.DemandeTravauxResumeDto[];
}>();
</script>

<template>
    <Head title="Demandes de travaux" />

    <h1 class="text-2xl font-semibold">Demandes de travaux</h1>

    <p v-if="demandes.length === 0" class="text-gray-500">
        Aucune demande pour l'instant.
    </p>

    <ul v-else class="divide-y">
        <li v-for="demande in demandes" :key="demande.id" class="py-3">
            <Link
                :href="`/bailleur/travaux/${demande.id}`"
                class="font-medium hover:underline"
            >
                {{ demande.titre }}
            </Link>
            <span class="ml-2 text-sm text-gray-500">
                {{ demande.adresseLogement }} · {{ demande.urgence }} ·
                {{ demande.statut }} · {{ demande.soumiseLe }}
            </span>
        </li>
    </ul>
</template>
