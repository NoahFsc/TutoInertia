<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Exceptions;

use App\Domain\Logement\Models\Logement;
use DomainException;

final class LogementNonOccupeException extends DomainException
{
    public function __construct(public readonly Logement $logement)
    {
        parent::__construct("Le logement {$logement->adresse} n'est pas occupé, aucune demande de travaux n'est possible.");
    }
}
