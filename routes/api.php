<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/people/{name}', [PeopleController::class, 'show']);

Route::get('/episode/{number}/species', [EpisodeController::class, 'showAllSpeciesClassifications']);

Route::get('/planet/population/all', [PlanetController::class, 'showPopulationOfUniverse']);
