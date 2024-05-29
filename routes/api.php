<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



/**
 * SHOWS & REPRESENTATIONS
 */
//afficher les spectacles

Route::get('/shows', [\App\Http\Controllers\Api\ShowController::class, 'index']);

//afficher un spectacle

Route::get('/shows/{id}', [\App\Http\Controllers\Api\ShowController::class, 'show'])->where('id', '[0-9]+');

// afficher les représentations d'un spectacle

Route::get('/shows/{id}/representations', [\App\Http\Controllers\Api\ShowController::class, 'representation']);

//filtrer les spectacles par best-rated

Route::get('/shows/best-rated', [\App\Http\Controllers\Api\ShowController::class, 'bestRated']);


/**
 * REVIEWS 
 */

//afficher les commentaires d'un spectacle
Route::get('/shows/{id}/reviews', [\App\Http\Controllers\Api\ShowController::class, 'reviews']);

//ajouter un commentaire à un spectacle digit 0-9
Route::post('/shows/{id}/reviews', [\App\Http\Controllers\Api\ShowController::class, 'store']);

//modifier le commentaire d'un spectacle
Route::put('/shows/{id}/reviews/{reviewId}', [\App\Http\Controllers\Api\ShowController::class, 'update']);

//supprimer le commentaire d'un spectacle

Route::delete('/shows/{id}/reviews/{reviewId}', [\App\Http\Controllers\Api\ShowController::class, 'destroy']);







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
