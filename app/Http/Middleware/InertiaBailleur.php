<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class InertiaBailleur
{
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::setRootView('app-bailleur');
        $request->attributes->set('espace', 'app-bailleur');

        return $next($request);
    }
}
