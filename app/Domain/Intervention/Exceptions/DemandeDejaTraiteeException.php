<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Exceptions;

use App\Domain\Intervention\Models\DemandeTravaux;
use DomainException;

final class DemandeDejaTraiteeException extends DomainException
{
    public function __construct(public readonly DemandeTravaux $demande)
    {
        parent::__construct("La demande « {$demande->titre} » a déjà été traitée.");
    }
}
