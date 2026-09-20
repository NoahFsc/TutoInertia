<?php

declare(strict_types=1);

namespace App\Http\Controllers\Bailleur;

use App\Domain\Intervention\Actions\AccepterDemande;
use App\Domain\Intervention\Dto\DemandeTravauxResumeDto;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DemandeTravauxController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Bailleur/Travaux/Index', [
            'demandes' => DemandeTravauxResumeDto::collect(
                DemandeTravaux::with('logement')
                    ->whereRelation('logement', 'proprietaire_id', $request->user()->id)
                    ->latest()
                    ->get()
            ),
        ]);
    }

    public function show(Request $request, DemandeTravaux $demande): Response
    {
        $this->authorize('view', $demande);

        return Inertia::render('Bailleur/Travaux/Show', [
            'demande' => DemandeTravauxResumeDto::from($demande->load('logement')),
            'peutTraiter' => $request->user()->can('traiter', $demande),
        ]);
    }

    public function accepter(DemandeTravaux $demande, AccepterDemande $action): RedirectResponse
    {
        $this->authorize('traiter', $demande);

        $action->handle($demande);

        return redirect()
            ->route('bailleur.travaux.show', $demande)
            ->with('succes', 'Demande acceptée, le locataire est prévenu.');
    }
}
