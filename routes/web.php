<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/auth/player')
    ->name('auth.player.')
    ->group(function () {

        Route::get('/login', App\Livewire\Auth\Player\Login::class)
            ->name('login');

    });

Route::prefix('/auth/scout')
    ->name('auth.scout.')
    ->group(function () {

        Route::get('/login', App\Livewire\Auth\Scout\Login::class)
            ->name('login');

    });