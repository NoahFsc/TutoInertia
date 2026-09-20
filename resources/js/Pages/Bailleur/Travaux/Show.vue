<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    demande: App.Domain.Intervention.Dto.DemandeTravauxResumeDto;
    peutTraiter: boolean;
}>();
</script>

<template>
    <Head :title="demande.titre" />

    <Link href="/bailleur/travaux" class="text-sm text-gray-500"
        >← Demandes</Link
    >

    <h1 class="text-2xl font-semibold">{{ demande.titre }}</h1>
    <p class="text-sm text-gray-500">
        {{ demande.adresseLogement }} · {{ demande.urgence }} ·
        {{ demande.statut }} · {{ demande.soumiseLe }}
    </p>
    <p class="max-w-prose">{{ demande.description }}</p>

    <button
        v-if="peutTraiter"
        type="button"
        class="rounded bg-gray-900 px-4 py-2 text-white"
        @click="router.post(`/bailleur/travaux/${demande.id}/accepter`)"
        >
        Accepter
    </button>
</template>
