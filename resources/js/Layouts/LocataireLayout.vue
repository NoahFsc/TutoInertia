<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { logout } from '@/routes';
import FlashMessage from '@/Shared/Components/FlashMessage.vue';

// Layout persistant : il n'est pas remonté entre deux pages.
// Son état local (menu ouvert, filtre saisi) survit donc à la navigation.
</script>

<template>
    <div class="min-h-svh">
        <header class="border-b border-gray-200 bg-white">
            <nav
                class="mx-auto flex max-w-5xl items-center gap-6 px-6 py-3 text-sm"
            >
                <Link href="/locataire" class="font-semibold tracking-tight"
                    >{{ $page.props.name }} · Locataire</Link
                >
                <Link
                    href="/locataire/travaux"
                    class="text-gray-600 hover:text-gray-900"
                    >Mes demandes</Link
                >
                <span class="ml-auto text-gray-500">{{
                    $page.props.auth.user?.name
                }}</span>
                <Link
                    :href="logout()"
                    as="button"
                    class="text-gray-600 hover:text-gray-900"
                >
                    Déconnexion
                </Link>
            </nav>
        </header>

        <main class="mx-auto max-w-5xl space-y-6 px-6 py-8">
            <FlashMessage />
            <slot />
        </main>
    </div>
</template>
