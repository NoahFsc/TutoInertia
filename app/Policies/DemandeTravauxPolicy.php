<?php

declare(strict_types=1);

namespace App\Policies;

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;

class DemandeTravauxPolicy
{
    public function create(User $user, Logement $logement): bool
    {
        return $user->id === $logement->locataire_id;
    }

    public function view(User $user, DemandeTravaux $demande): bool
    {
        return $user->id === $demande->auteur_id
            || $user->id === $demande->logement->proprietaire_id;
    }

    public function traiter(User $user, DemandeTravaux $demande): bool
    {
        return $user->id === $demande->logement->proprietaire_id
            && $demande->statut === StatutDemande::EnAttente;
    }
}
