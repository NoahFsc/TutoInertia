<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    logement: { id: number; adresse: string } | null;
}>();
</script>

<template>
    <Head title="Espace locataire" />

    <h1 class="text-2xl font-semibold">
        Bonjour {{ $page.props.auth.user?.name }}
    </h1>

    <div v-if="logement" class="rounded-md border border-gray-200 bg-white p-4">
        <p class="text-sm text-gray-500">Votre logement</p>
        <p class="font-medium">{{ logement.adresse }}</p>
        <Link
            :href="`/locataire/logements/${logement.id}/travaux/nouvelle`"
            class="mt-2 inline-block text-sm underline"
        >
            Signaler un problème
        </Link>
    </div>
    <p v-else class="text-gray-600">
        Aucun logement ne vous est rattaché pour l'instant.
    </p>
</template>
