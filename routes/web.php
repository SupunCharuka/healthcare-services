<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;



Route::get('', [FrontendController::class, 'index'])->name('/');
Route::get('services', [FrontendController::class, 'services'])->name('services');
Route::get('shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('about',[FrontendController::class, 'about'])->name('about');
Route::get('contact',[FrontendController::class, 'contact'])->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
