<?php

declare(strict_types=1);

use App\Domain\Intervention\Actions\SoumettreDemande;
use App\Domain\Intervention\Dto\DemandeTravauxDto;
use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Enums\Urgence;
use App\Domain\Intervention\Events\DemandeSoumise;
use App\Domain\Intervention\Exceptions\LogementNonOccupeException;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use Illuminate\Support\Facades\Event;

it('refuse une demande sur un logement libre', function () {
    $logement = Logement::factory()->create();
    $locataire = User::factory()->locataire()->create();

    expect(fn () => app(SoumettreDemande::class)->handle(
        $locataire,
        $logement,
        new DemandeTravauxDto('Fuite', 'Une fuite continue depuis ce matin.', Urgence::Haute),
    ))->toThrow(LogementNonOccupeException::class);
});

it('crée une demande en attente et émet l\'événement', function () {
    Event::fake();
    $locataire = User::factory()->locataire()->create();
    $logement = Logement::factory()->occupe()->for($locataire, 'locataire')->create();

    $demande = app(SoumettreDemande::class)->handle(
        $locataire,
        $logement,
        new DemandeTravauxDto('Fuite', 'Une fuite continue depuis ce matin.', Urgence::Haute),
    );

    expect($demande->statut)->toBe(StatutDemande::EnAttente)
        ->and($demande->auteur_id)->toBe($locataire->id);
    Event::assertDispatched(DemandeSoumise::class);
});
