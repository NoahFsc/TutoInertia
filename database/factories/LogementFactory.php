<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Logement\Enums\StatutLogement;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Logement> */
class LogementFactory extends Factory
{
    protected $model = Logement::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adresse' => fake()->streetAddress(),
            'surface' => fake()->numberBetween(18, 95),
            'loyer_cents' => fake()->numberBetween(35_000, 120_000),
            'statut' => StatutLogement::Libre,
            'proprietaire_id' => User::factory()->bailleur(),
        ];
    }

    public function occupe(): static
    {
        // Un locataire fourni par for() est conservé ; sinon on en fabrique un.
        return $this->state(fn (array $attributes) => [
            'statut' => StatutLogement::Occupe,
            'locataire_id' => $attributes['locataire_id'] ?? User::factory()->locataire(),
        ]);
    }
}
