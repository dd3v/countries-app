<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('api')
    ->as('api.')
    ->middleware(['ensure.json', 'auth'])
    ->group(function () {
        Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    });
