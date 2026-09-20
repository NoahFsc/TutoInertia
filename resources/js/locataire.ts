import { createInertiaApp } from '@inertiajs/vue3';
import LocataireLayout from '@/Layouts/LocataireLayout.vue';

void createInertiaApp({
    // Le plugin @inertiajs/vite génère le résolveur : 'Locataire/Logements/Index'
    // devient ./Pages/Locataire/Logements/Index.vue, et rien d'autre n'est inclus.
    pages: {
        path: './Pages/Locataire',
        transform: (name: string) => name.replace(/^Locataire\//, ''),
    },
    layout: () => LocataireLayout,
});
