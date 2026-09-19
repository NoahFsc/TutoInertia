<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { login } from '@/routes';
import { email } from '@/routes/password';
import Bouton from '@/Shared/Components/Bouton.vue';
import InputError from '@/Shared/Components/InputError.vue';
import TextLink from '@/Shared/Components/TextLink.vue';

defineOptions({
    layout: {
        title: 'Mot de passe oublié',
        description:
            'Entrez votre e-mail pour recevoir un lien de réinitialisation.',
    },
});

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Mot de passe oublié" />

    <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <Form
        v-bind="email.form()"
        #default="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-1.5">
            <label for="email" class="text-sm font-medium text-gray-700"
                >Adresse e-mail</label
            >
            <input
                id="email"
                type="email"
                name="email"
                autocomplete="off"
                autofocus
                placeholder="email@exemple.fr"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.email" />
        </div>

        <Bouton type="submit" class="w-full" :disabled="processing"
            >Envoyer le lien</Bouton
        >

        <p class="text-center text-sm text-gray-500">
            Ou revenir à la
            <TextLink :href="login()">connexion</TextLink>
        </p>
    </Form>
</template>
