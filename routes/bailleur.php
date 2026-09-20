<?php

use App\Http\Controllers\Bailleur\DemandeTravauxController;
use App\Http\Controllers\Bailleur\LogementController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Bailleur/Accueil')->name('accueil');

Route::get('/logements', [LogementController::class, 'index'])->name('logements.index');
Route::get('/travaux', [DemandeTravauxController::class, 'index'])->name('travaux.index');
Route::get('/travaux/{demande}', [DemandeTravauxController::class, 'show'])->name('travaux.show');
Route::post('/travaux/{demande}/accepter', [DemandeTravauxController::class, 'accepter'])->name('travaux.accepter');
