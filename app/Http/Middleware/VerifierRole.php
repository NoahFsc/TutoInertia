<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\Shared\Enums\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifierRole
{
    /**
     * Utilisé comme `role:bailleur` ou `role:locataire` sur un groupe de routes.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        abort_unless($request->user()?->role === Role::from($role), 403);

        return $next($request);
    }
}
