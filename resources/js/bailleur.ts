import { createInertiaApp } from '@inertiajs/vue3';
import BailleurLayout from '@/Layouts/BailleurLayout.vue';

void createInertiaApp({
    // Le plugin @inertiajs/vite génère le résolveur : 'Bailleur/Logements/Index'
    // devient ./Pages/Bailleur/Logements/Index.vue, et rien d'autre n'est inclus.
    pages: {
        path: './Pages/Bailleur',
        transform: (name: string) => name.replace(/^Bailleur\//, ''),
    },
    layout: () => BailleurLayout,
});
