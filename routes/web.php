<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/auth/player')
    ->name('auth.player.')
    ->group(function () {

        Route::get('/login', App\Livewire\Auth\Player\Login::class)
            ->name('login');

    });