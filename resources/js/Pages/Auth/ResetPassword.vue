<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { update } from '@/routes/password';
import Bouton from '@/Shared/Components/Bouton.vue';
import InputError from '@/Shared/Components/InputError.vue';

defineOptions({
    layout: {
        title: 'Nouveau mot de passe',
        description: 'Choisissez un nouveau mot de passe.',
    },
});

defineProps<{
    token: string;
    email: string;
    passwordRules: string;
}>();
</script>

<template>
    <Head title="Nouveau mot de passe" />

    <Form
        v-bind="update.form()"
        :transform="(data) => ({ ...data, token, email })"
        :reset-on-success="['password', 'password_confirmation']"
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
                autocomplete="email"
                :value="email"
                readonly
                class="w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2 text-sm"
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
                autocomplete="new-password"
                autofocus
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
                autocomplete="new-password"
                :passwordrules="passwordRules"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.password_confirmation" />
        </div>

        <Bouton type="submit" class="w-full" :disabled="processing"
            >Réinitialiser</Bouton
        >
    </Form>
</template>
