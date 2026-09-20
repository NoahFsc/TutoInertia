<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bailleur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LogementController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Bailleur/Logements/Index', [
            'logements' => $request->user()
                ->logements()
                ->withCount('demandesTravaux')
                ->orderBy('adresse')
                ->get(),
        ]);
    }
}
