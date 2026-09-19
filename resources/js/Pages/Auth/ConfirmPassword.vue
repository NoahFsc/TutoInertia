<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { store } from '@/routes/password/confirm';
import Bouton from '@/Shared/Components/Bouton.vue';
import InputError from '@/Shared/Components/InputError.vue';

defineOptions({
    layout: {
        title: 'Confirmer le mot de passe',
        description:
            'Zone sensible : confirmez votre mot de passe pour continuer.',
    },
});
</script>

<template>
    <Head title="Confirmer le mot de passe" />

    <Form
        v-bind="store.form()"
        reset-on-success
        #default="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-1.5">
            <label for="password" class="text-sm font-medium text-gray-700"
                >Mot de passe</label
            >
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                autofocus
                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm"
            />
            <InputError :message="errors.password" />
        </div>

        <Bouton type="submit" class="w-full" :disabled="processing"
            >Confirmer</Bouton
        >
    </Form>
</template>
