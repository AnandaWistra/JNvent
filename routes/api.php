<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

// Route default bawaan Laravel untuk cek user (bisa dibiarkan)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ROUTE API UNTUK EVENT
Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);