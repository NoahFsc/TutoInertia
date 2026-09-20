<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Actions;

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Events\DemandeAcceptee;
use App\Domain\Intervention\Exceptions\DemandeDejaTraiteeException;
use App\Domain\Intervention\Models\DemandeTravaux;
use Illuminate\Support\Facades\DB;

final readonly class AccepterDemande
{
    public function handle(DemandeTravaux $demande): DemandeTravaux
    {
        if ($demande->statut !== StatutDemande::EnAttente) {
            throw new DemandeDejaTraiteeException($demande);
        }

        return DB::transaction(function () use ($demande) {
            $demande->update(['statut' => StatutDemande::Acceptee]);

            DemandeAcceptee::dispatch($demande);

            return $demande;
        });
    }
}
