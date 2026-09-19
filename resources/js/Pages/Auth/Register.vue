<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { login } from '@/routes';
import { store } from '@/routes/register';
import Bouton from '@/Shared/Components/Bouton.vue';
import InputError from '@/Shared/Components/InputError.vue';
import TextLink from '@/Shared/Components/TextLink.vue';

defineOptions({
    layout: {
        title: 'Créer un compte',
        description: 'Entrez vos informations ci-dessous.',
    },
});

defineProps<{
    passwordRules: string;
}>();
</script>

<template>
    <Head title="Inscription" />

    <Form
        v-bind="store.form()"
        :reset-on-success="['password', 'password_confirmation']"
        #default="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-1.5">
            <label for="name" class="text-sm font-medium text-gray-700"
                >Nom</label
            >
            <input
                id="name"
                type="text"
                name="name"
                required
                autofocus
                autocomplete="name"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.name" />
        </div>

        <div class="grid gap-1.5">
            <label for="email" class="text-sm font-medium text-gray-700"
                >Adresse e-mail</label
            >
            <input
                id="email"
                type="email"
                name="email"
                required
                autocomplete="email"
                placeholder="email@exemple.fr"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.email" />
        </div>

        <div class="grid gap-1.5">
            <label for="password" class="text-sm font-medium text-gray-700"
                >Mot de passe</label
            >
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                :passwordrules="passwordRules"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.password" />
        </div>

        <div class="grid gap-1.5">
            <label
                for="password_confirmation"
                class="text-sm font-medium text-gray-700"
            >
                Confirmer le mot de passe
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                :passwordrules="passwordRules"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.password_confirmation" />
        </div>

        <Bouton type="submit" class="w-full" :disabled="processing"
            >Créer le compte</Bouton
        >

        <p class="text-center text-sm text-gray-500">
            Déjà un compte ?
            <TextLink :href="login()">Se connecter</TextLink>
        </p>
    </Form>
</template>
