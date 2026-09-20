<?php

use App\Http\Controllers\Shared\RedirectionApresConnexionController;
use App\Http\Middleware\InertiaBailleur;
use App\Http\Middleware\InertiaLocataire;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::get('/dashboard', RedirectionApresConnexionController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:bailleur', InertiaBailleur::class])
    ->prefix('bailleur')
    ->name('bailleur.')
    ->group(base_path('routes/bailleur.php'));

Route::middleware(['auth', 'verified', 'role:locataire', InertiaLocataire::class])
    ->prefix('locataire')
    ->name('locataire.')
    ->group(base_path('routes/locataire.php'));
