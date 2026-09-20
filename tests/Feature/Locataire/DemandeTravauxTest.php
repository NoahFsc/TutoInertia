<?php

declare(strict_types=1);

use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;

it('permet au locataire de soumettre une demande sur son logement', function () {
    $locataire = User::factory()->locataire()->create();
    $logement = Logement::factory()->occupe()->for($locataire, 'locataire')->create();

    $this->actingAs($locataire)
        ->post("/locataire/logements/{$logement->id}/travaux", [
            'titre' => 'Fuite sous l\'évier',
            'description' => 'Une fuite continue depuis ce matin sous le meuble.',
            'urgence' => 'haute',
        ])
        ->assertRedirect(route('locataire.travaux.index'))
        ->assertSessionHas('succes');

    expect(DemandeTravaux::count())->toBe(1);
});

it('refuse une description trop courte', function () {
    $locataire = User::factory()->locataire()->create();
    $logement = Logement::factory()->occupe()->for($locataire, 'locataire')->create();

    $this->actingAs($locataire)
        ->post("/locataire/logements/{$logement->id}/travaux", [
            'titre' => 'Fuite',
            'description' => 'Trop court.',
            'urgence' => 'haute',
        ])
        ->assertSessionHasErrors('description');

    expect(DemandeTravaux::count())->toBe(0);
});

it('interdit une demande sur le logement d\'un autre locataire', function () {
    $locataire = User::factory()->locataire()->create();
    $logementDUnAutre = Logement::factory()->occupe()->create();

    $this->actingAs($locataire)
        ->post("/locataire/logements/{$logementDUnAutre->id}/travaux", [
            'titre' => 'Fuite sous l\'évier',
            'description' => 'Une fuite continue depuis ce matin sous le meuble.',
            'urgence' => 'haute',
        ])
        ->assertForbidden();
});
