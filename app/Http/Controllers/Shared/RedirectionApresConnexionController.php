<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectionApresConnexionController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        return $request->user()->estLocataire()
            ? redirect()->route('locataire.accueil')
            : redirect()->route('bailleur.accueil');
    }
}
