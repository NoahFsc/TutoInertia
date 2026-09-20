<?php

declare(strict_types=1);

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use App\Notifications\DemandeTravauxAcceptee;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;

it('affiche au bailleur les demandes de ses logements seulement', function () {
    $bailleur = User::factory()->bailleur()->create();
    $logement = Logement::factory()->occupe()->for($bailleur, 'proprietaire')->create();
    DemandeTravaux::factory()->count(3)->for($logement)->create();
    DemandeTravaux::factory()->create();

    $this->actingAs($bailleur)
        ->get('/bailleur/travaux')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Bailleur/Travaux/Index')
            ->has('demandes', 3)
            ->where('demandes.0.statut', 'en_attente')
        );
});

it('accepte une demande et prévient le locataire', function () {
    Notification::fake();
    $bailleur = User::factory()->bailleur()->create();
    $logement = Logement::factory()->occupe()->for($bailleur, 'proprietaire')->create();
    $demande = DemandeTravaux::factory()->for($logement)->for($logement->locataire, 'auteur')->create();

    $this->actingAs($bailleur)
        ->post("/bailleur/travaux/{$demande->id}/accepter")
        ->assertRedirect(route('bailleur.travaux.show', $demande));

    expect($demande->fresh()->statut)->toBe(StatutDemande::Acceptee);
    Notification::assertSentTo($logement->locataire, DemandeTravauxAcceptee::class);
});

it('interdit à un autre bailleur d\'accepter la demande', function () {
    $demande = DemandeTravaux::factory()->create();
    $autreBailleur = User::factory()->bailleur()->create();

    $this->actingAs($autreBailleur)
        ->post("/bailleur/travaux/{$demande->id}/accepter")
        ->assertForbidden();
});
