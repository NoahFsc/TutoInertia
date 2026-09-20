<?php

declare(strict_types=1);

namespace App\Domain\Shared\Enums;

enum Role: string
{
    case Bailleur = 'bailleur';
    case Locataire = 'locataire';
}
