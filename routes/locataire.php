<?php

use App\Http\Controllers\Locataire\AccueilController;
use App\Http\Controllers\Locataire\DemandeTravauxController;
use Illuminate\Support\Facades\Route;

Route::get('/', AccueilController::class)->name('accueil');

Route::get('/logements/{logement}/travaux/nouvelle', [DemandeTravauxController::class, 'create'])->name('travaux.create');
Route::post('/logements/{logement}/travaux', [DemandeTravauxController::class, 'store'])->name('travaux.store');
Route::get('/travaux', [DemandeTravauxController::class, 'index'])->name('travaux.index');
