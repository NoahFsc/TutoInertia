<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Enums;

enum Urgence: string
{
    case Basse = 'basse';
    case Normale = 'normale';
    case Haute = 'haute';

    public function libelle(): string
    {
        return match ($this) {
            self::Basse => 'Basse',
            self::Normale => 'Normale',
            self::Haute => 'Haute',
        };
    }
}
