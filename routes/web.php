<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ContributerController;
use App\Http\Controllers\RepositoryController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/github/redirect', [ProviderController::class, 'redirect']);              // Github OAuth redirect route
Route::get('/auth/github/callback', [ProviderController::class, 'callback']);               // Github OAuth accept route

Route::get('/dashboard', [RepositoryController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/project', ProjectController::class);

require __DIR__.'/auth.php';
