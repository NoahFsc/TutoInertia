<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Dto;

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Enums\Urgence;
use App\Domain\Intervention\Models\DemandeTravaux;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class DemandeTravauxResumeDto extends Data
{
    public function __construct(
        public int $id,
        public string $titre,
        public string $description,
        public Urgence $urgence,
        public StatutDemande $statut,
        public string $adresseLogement,
        public string $soumiseLe,
    ) {}

    public static function fromModel(DemandeTravaux $demande): self
    {
        return new self(
            id: $demande->id,
            titre: $demande->titre,
            description: $demande->description,
            urgence: $demande->urgence,
            statut: $demande->statut,
            adresseLogement: $demande->logement->adresse,
            soumiseLe: $demande->created_at?->format('d/m/Y') ?? '',
        );
    }
}
