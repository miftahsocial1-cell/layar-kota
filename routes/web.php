<?php

use App\Http\Controllers\CinemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CinemaController::class, 'catalog'])->name('catalog');
Route::get('/film/{film:slug}', [CinemaController::class, 'detail'])->name('films.show');
Route::get('/jadwal/{showtime}/pesan', [CinemaController::class, 'booking'])->name('bookings.create');
Route::post('/jadwal/{showtime}/pesan', [CinemaController::class, 'reserve'])->name('bookings.store');
Route::get('/e-ticket/{reservation:code}', [CinemaController::class, 'ticket'])->name('tickets.show');
