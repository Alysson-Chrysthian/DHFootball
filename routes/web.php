<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/auth')
    ->name('auth.')
    ->group(function () {

        Route::prefix('/player')
            ->name('player.')
            ->group(function () {

                Route::get('/login', App\Livewire\Auth\Player\Login::class)
                    ->name('login');

            });
            
    });