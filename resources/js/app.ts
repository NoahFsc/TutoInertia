import { createInertiaApp } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';

// Le plugin @inertiajs/vite résout les pages depuis resources/js/Pages :
// Inertia::render('Auth/Login') → resources/js/Pages/Auth/Login.vue

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

void createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: (name) => {
        switch (true) {
            case name === 'Welcome':
                return null;
            case name.startsWith('Auth/'):
                return AuthLayout;
            default:
                return AppLayout;
        }
    },
    progress: {
        color: '#4B5563',
    },
});
