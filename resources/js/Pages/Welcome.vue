<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
</script>

<template>
    <Head title="Accueil" />

    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 text-center"
    >
        <h1 class="text-3xl font-semibold tracking-tight">
            {{ $page.props.name }}
        </h1>
        <p class="max-w-md text-gray-600">
            Template Laravel + Inertia + Vue + Tailwind.
        </p>
        <nav class="flex gap-4 text-sm">
            <Link
                v-if="$page.props.auth.user"
                :href="dashboard()"
                class="rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-700"
            >
                Tableau de bord
            </Link>
            <template v-else>
                <Link
                    :href="login()"
                    class="rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-700"
                >
                    Connexion
                </Link>
                <Link
                    :href="register()"
                    class="rounded-md border border-gray-300 px-4 py-2 hover:bg-gray-100"
                >
                    Inscription
                </Link>
            </template>
        </nav>
    </div>
</template>
