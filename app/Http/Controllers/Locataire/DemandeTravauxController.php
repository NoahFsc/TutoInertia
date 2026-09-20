<?php

declare(strict_types=1);

namespace App\Http\Controllers\Locataire;

use App\Domain\Intervention\Actions\SoumettreDemande;
use App\Domain\Intervention\Dto\DemandeTravauxDto;
use App\Domain\Intervention\Dto\DemandeTravauxResumeDto;
use App\Domain\Intervention\Enums\Urgence;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Models\Logement;
use App\Http\Controllers\Controller;
use App\Http\Requests\Locataire\StoreDemandeTravauxRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DemandeTravauxController extends Controller
{
    public function create(Logement $logement): Response
    {
        $this->authorize('create', [DemandeTravaux::class, $logement]);

        return Inertia::render('Locataire/Travaux/Create', [
            'logementId' => $logement->id,
            'urgences' => array_map(
                fn (Urgence $urgence) => ['valeur' => $urgence->value, 'libelle' => $urgence->libelle()],
                Urgence::cases(),
            ),
        ]);
    }

    public function store(
        StoreDemandeTravauxRequest $request,
        Logement $logement,
        SoumettreDemande $action,
    ): RedirectResponse {
        $this->authorize('create', [DemandeTravaux::class, $logement]);

        $action->handle(
            $request->user(),
            $logement,
            DemandeTravauxDto::from($request->validated()),
        );

        return redirect()
            ->route('locataire.travaux.index')
            ->with('succes', 'Votre demande a bien été transmise.');
    }

    public function index(Request $request): Response
    {
        return Inertia::render('Locataire/Travaux/Index', [
            'demandes' => DemandeTravauxResumeDto::collect(
                DemandeTravaux::with('logement')
                    ->where('auteur_id', $request->user()->id)
                    ->latest()
                    ->get()
            ),
        ]);
    }
}
