<?php

declare(strict_types=1);

namespace App\Http\Controllers\Locataire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AccueilController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $logement = $request->user()->logement;

        return Inertia::render('Locataire/Accueil', [
            'logement' => $logement === null ? null : [
                'id' => $logement->id,
                'adresse' => $logement->adresse,
            ],
        ]);
    }
}
