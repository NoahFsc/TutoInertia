<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class InertiaLocataire
{
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::setRootView('app-locataire');
        $request->attributes->set('espace', 'app-locataire');

        return $next($request);
    }
}
