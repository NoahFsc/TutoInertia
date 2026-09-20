<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Enums\Urgence;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<DemandeTravaux> */
class DemandeTravauxFactory extends Factory
{
    protected $model = DemandeTravaux::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logement_id' => Logement::factory(),
            'auteur_id' => User::factory(),
            'titre' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'urgence' => Urgence::Normale,
            'statut' => StatutDemande::EnAttente,
        ];
    }
}
