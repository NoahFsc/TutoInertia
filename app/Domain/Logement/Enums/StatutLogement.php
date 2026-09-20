<?php

declare(strict_types=1);

namespace App\Domain\Logement\Enums;

enum StatutLogement: string
{
    case Libre = 'libre';
    case Occupe = 'occupe';

    public function libelle(): string
    {
        return match ($this) {
            self::Libre => 'Libre',
            self::Occupe => 'Occupé',
        };
    }
}
