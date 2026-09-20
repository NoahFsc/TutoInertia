<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    logementId: number;
    urgences: Array<{ valeur: string; libelle: string }>;
}>();

const form = useForm({
    titre: '',
    description: '',
    urgence: 'normale',
});

function soumettre() {
    form.post(`/locataire/logements/${props.logementId}/travaux`, {
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <Head title="Nouvelle demande de travaux" />

    <h1 class="text-2xl font-semibold">Nouvelle demande de travaux</h1>

    <form @submit.prevent="soumettre" class="max-w-md space-y-4">
        <div>
            <label for="titre" class="block text-sm font-medium">Titre</label>
            <input
                id="titre"
                v-model="form.titre"
                class="w-full rounded border px-3 py-2"
            />
            <p v-if="form.errors.titre" class="text-sm text-red-600">
                {{ form.errors.titre }}
            </p>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium"
                >Description</label
            >
            <textarea
                id="description"
                v-model="form.description"
                rows="4"
                class="w-full rounded border px-3 py-2"
            />
            <p v-if="form.errors.description" class="text-sm text-red-600">
                {{ form.errors.description }}
            </p>
        </div>

        <div>
            <label for="urgence" class="block text-sm font-medium"
                >Urgence</label
            >
            <select
                id="urgence"
                v-model="form.urgence"
                class="w-full rounded border px-3 py-2"
            >
                <option
                    v-for="urgence in props.urgences"
                    :key="urgence.valeur"
                    :value="urgence.valeur"
                >
                    {{ urgence.libelle }}
                </option>
            </select>
            <p v-if="form.errors.urgence" class="text-sm text-red-600">
                {{ form.errors.urgence }}
            </p>
        </div>

        <button
            type="submit"
            :disabled="form.processing"
            class="rounded bg-gray-900 px-4 py-2 text-white"
        >
            {{ form.processing ? 'Envoi…' : 'Envoyer la demande' }}
        </button>
    </form>
</template>
