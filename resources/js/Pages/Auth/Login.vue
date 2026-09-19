<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import Bouton from '@/Shared/Components/Bouton.vue';
import InputError from '@/Shared/Components/InputError.vue';
import TextLink from '@/Shared/Components/TextLink.vue';

defineOptions({
    layout: {
        title: 'Connexion',
        description: 'Entrez votre e-mail et votre mot de passe.',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Connexion" />

    <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
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
                required
                autofocus
                autocomplete="email"
                placeholder="email@exemple.fr"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.email" />
        </div>

        <div class="grid gap-1.5">
            <div class="flex items-center justify-between">
                <label for="password" class="text-sm font-medium text-gray-700"
                    >Mot de passe</label
                >
                <TextLink
                    v-if="canResetPassword"
                    :href="request()"
                    class="text-sm"
                >
                    Mot de passe oublié ?
                </TextLink>
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.password" />
        </div>

        <label for="remember" class="flex items-center gap-2 text-sm">
            <input
                id="remember"
                type="checkbox"
                name="remember"
                class="rounded border-gray-300"
            />
            Se souvenir de moi
        </label>

        <Bouton type="submit" class="w-full" :disabled="processing"
            >Se connecter</Bouton
        >

        <p class="text-center text-sm text-gray-500">
            Pas encore de compte ?
            <TextLink :href="register()">Créer un compte</TextLink>
        </p>
    </Form>
</template>
