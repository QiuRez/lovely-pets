<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])
    ->name('home');

Route::middleware('guest')->group(function () {
    Route::get('users/register', [AuthController::class, 'register'])
        ->name('users.register');

    Route::post('users/register', [AuthController::class, 'registerStore'])
        ->name('users.register.store');

    Route::get('users/login', [AuthController::class, 'login'])
        ->name('users.login');

    Route::post('users/login', [AuthController::class, 'loginStore'])
        ->name('users.login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('users/logout', [AuthController::class, 'logout'])
        ->name('users.logout');

    Route::get('/pets/pet', [PetController::class, 'pet'])
        ->name('pets.pet');

    Route::get('/pets/list', [PetController::class, 'list'])
        ->name('pets.list');
});


