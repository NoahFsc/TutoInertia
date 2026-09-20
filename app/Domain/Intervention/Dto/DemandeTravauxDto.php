<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Dto;

use App\Domain\Intervention\Enums\Urgence;
use Spatie\LaravelData\Data;

final class DemandeTravauxDto extends Data
{
    public function __construct(
        public string $titre,
        public string $description,
        public Urgence $urgence,
    ) {}
}
