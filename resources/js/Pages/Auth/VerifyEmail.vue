<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { logout } from '@/routes';
import { send } from '@/routes/verification';
import Bouton from '@/Shared/Components/Bouton.vue';
import TextLink from '@/Shared/Components/TextLink.vue';

defineOptions({
    layout: {
        title: "Vérification de l'e-mail",
        description:
            'Cliquez sur le lien que nous venons de vous envoyer par e-mail.',
    },
});

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Vérification de l'e-mail" />

    <div
        v-if="status === 'verification-link-sent'"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
    </div>

    <Form
        v-bind="send.form()"
        #default="{ processing }"
        class="flex flex-col gap-6 text-center"
    >
        <Bouton type="submit" variante="secondaire" :disabled="processing">
            Renvoyer l'e-mail de vérification
        </Bouton>

        <TextLink :href="logout()" as="button" class="mx-auto text-sm"
            >Se déconnecter</TextLink
        >
    </Form>
</template>
