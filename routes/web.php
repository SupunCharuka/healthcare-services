<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;



Route::get('', [FrontendController::class, 'index'])->name('/');
Route::get('services', [FrontendController::class, 'services'])->name('services');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
