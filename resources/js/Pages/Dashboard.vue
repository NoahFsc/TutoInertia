<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Tableau de bord" />

    <h1 class="text-2xl font-semibold tracking-tight">
        Bonjour {{ $page.props.auth.user?.name }}
    </h1>
    <p class="text-gray-600">
        La chaîne Laravel → Inertia → Vue → Vite fonctionne. Cette page est
        rendue par
        <code class="rounded bg-gray-100 px-1"
            >Route::inertia('dashboard', 'Dashboard')</code
        >
        dans <code class="rounded bg-gray-100 px-1">routes/web.php</code>.
    </p>
</template>
