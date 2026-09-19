<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';

// Le flash est partagé par HandleInertiaRequests::share() : ->with('succes', '…') côté contrôleur.
const page = usePage();
</script>

<template>
    <div
        v-if="page.props.flash.succes"
        class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
        role="status"
    >
        {{ page.props.flash.succes }}
    </div>
    <div
        v-else-if="page.props.flash.erreur"
        class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
        role="alert"
    >
        {{ page.props.flash.erreur }}
    </div>
</template>
