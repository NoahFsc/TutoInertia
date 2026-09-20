<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Actions;

use App\Domain\Intervention\Dto\DemandeTravauxDto;
use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Events\DemandeSoumise;
use App\Domain\Intervention\Exceptions\LogementNonOccupeException;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Enums\StatutLogement;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class SoumettreDemande
{
    public function handle(User $auteur, Logement $logement, DemandeTravauxDto $data): DemandeTravaux
    {
        if ($logement->statut !== StatutLogement::Occupe) {
            throw new LogementNonOccupeException($logement);
        }

        return DB::transaction(function () use ($auteur, $logement, $data) {
            $demande = DemandeTravaux::create([
                'logement_id' => $logement->id,
                'auteur_id' => $auteur->id,
                'titre' => $data->titre,
                'description' => $data->description,
                'urgence' => $data->urgence,
                'statut' => StatutDemande::EnAttente,
            ]);

            DemandeSoumise::dispatch($demande);

            return $demande;
        });
    }
}
