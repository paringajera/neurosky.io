<?php

use App\Http\Controllers\InsightsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/safety', [PageController::class, 'safety'])->name('safety');
Route::get('/research', [PageController::class, 'research'])->name('research');
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');

Route::get('/insights', [InsightsController::class, 'index'])->name('insights.index');
Route::get('/insights/{slug}', [InsightsController::class, 'show'])->name('insights.show');
