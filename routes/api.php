<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetController;
use Illuminate\Support\Facades\Route;

Route::controller(PeopleController::class)->group(function () {
    Route::prefix('people')->group(function () {
        Route::get('/{name}/ships', [PeopleController::class, 'ships']);
        Route::get('/{name}', [PeopleController::class, 'person']);
    });
});

Route::controller(EpisodeController::class)->group(function () {
    Route::prefix('episode')->group(function() {
        Route::get('/{number}/species', [EpisodeController::class, 'showAllSpeciesClassifications']);
        Route::get('/{number}', [EpisodeController::class, 'episode']);
    });
});

Route::controller(PlanetController::class)->group(function () {
    Route::prefix('planet')->group(function () {
        Route::get('/population/all', [PlanetController::class, 'populationOfUniverse']);
        Route::get('/{number}', [PlanetController::class, 'planet']);
    });
});
