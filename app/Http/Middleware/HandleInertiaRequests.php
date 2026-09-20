<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        // La version dépend de l'espace : en changeant d'espace, Inertia voit une
        // version différente et recharge la page entière, donc la bonne entrée Vite.
        return parent::version($request).'-'.$request->attributes->get('espace', 'app');
    }

    /**
     * Define the props that are shared by default.
     *
     * Ce qui est déclaré ici est présent sur TOUTES les pages :
     * utilisateur connecté, messages flash.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $user === null ? null : [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ],
            'flash' => [
                'succes' => $request->session()->get('succes'),
                'erreur' => $request->session()->get('erreur'),
            ],
        ];
    }
}
