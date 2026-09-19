# Template Laravel + Inertia + Vue

Socle minimal, prêt pour le tutoriel Mini-Bail. Il contient **uniquement** ce qu'on ne veut pas réécrire
à la main : l'authentification, l'outillage, et la structure de dossiers de l'équipe.

## Ce qu'il y a dedans

| Brique                         | Détail                                                                                                              |
| ------------------------------ | ------------------------------------------------------------------------------------------------------------------- |
| Laravel 13, PHP 8.4            | `app/Domain/Shared/Models/User.php` — pas de `app/Models`                                                           |
| Inertia 3 + Vue 3 + TypeScript | pages dans `resources/js/Pages`, layouts dans `Layouts`, communs dans `Shared`                                      |
| Tailwind 4 seul                | pas de bibliothèque de composants                                                                                   |
| Auth (Fortify)                 | connexion, inscription, mot de passe oublié / réinitialisation, vérification d'e-mail, confirmation de mot de passe |
| Wayfinder                      | fonctions TypeScript générées pour les routes : `import { login } from '@/routes'`                                  |
| Qualité                        | Pint, Larastan, Pest, ESLint + Prettier (via `vp check`), CI GitHub Actions                                         |

Rien d'autre. Pas de rôles, pas de modèles métier, pas de second espace : c'est le tutoriel qui les fait construire.

## Démarrer

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
```

Avec Herd, le site est servi sur `http://<nom-du-dossier>.test`. Créer un compte sur `/register`, arriver sur `/dashboard`.

## Vérifier

```bash
composer test        # pint --test, phpstan, pest
npm run check        # lint + format
npm run types:check  # vue-tsc
```

## Où sont les choses

```
app/
├── Actions/Fortify/          création de compte, réinitialisation (Fortify)
├── Domain/
│   ├── README.md             LA règle : rien de HTTP ici
│   └── Shared/Models/User.php
├── Http/
│   ├── Controllers/
│   └── Middleware/HandleInertiaRequests.php   props partagées : auth.user, flash
└── Providers/FortifyServiceProvider.php       vues d'auth → Inertia::render('Auth/…')

resources/
├── views/app.blade.php       vue racine Inertia
└── js/
    ├── app.ts                createInertiaApp + layouts par défaut
    ├── Layouts/              AppLayout, AuthLayout
    ├── Pages/                Welcome, Dashboard, Auth/*
    ├── Shared/Components/    Bouton, InputError, TextLink, FlashMessage
    └── types/                props partagées typées

routes/web.php                home, dashboard (les routes d'auth viennent de Fortify)
tests/Feature/Auth/           les tests d'auth du starter kit
```
