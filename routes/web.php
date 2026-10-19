<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect('/events');
});

Route::resource('events', EventController::class);

// ROUTE BARU UNTUK FILTER KATEGORI
Route::get('category/{id}', [EventController::class, 'category'])->name('events.category');