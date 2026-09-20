<?php

use App\Domain\Shared\Models\User;

test('guests are redirected to the login page', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('a bailleur is sent to the bailleur space', function () {
    $bailleur = User::factory()->bailleur()->create();

    $this->actingAs($bailleur)->get(route('dashboard'))->assertRedirect(route('bailleur.accueil'));
});

test('a locataire is sent to the locataire space', function () {
    $locataire = User::factory()->locataire()->create();

    $this->actingAs($locataire)->get(route('dashboard'))->assertRedirect(route('locataire.accueil'));
});
