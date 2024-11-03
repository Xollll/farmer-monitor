<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [HomeController::class, 'GraphPage'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// Separate API routes for real-time updates
Route::get('/chart-data', [HomeController::class, 'getChartData']);
Route::get('/ph-chart', [HomeController::class, 'PhChartData']);
