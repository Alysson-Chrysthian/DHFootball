<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
        'guest:player', 
        'guest:scout'
    ])
    ->prefix('/auth')
    ->name('auth.')
    ->group(function () {

        Route::prefix('/player')
            ->name('player.')
            ->group(function () {

                Route::get('/login', App\Livewire\Auth\Player\Login::class)
                    ->name('login');

            });

        Route::prefix('/scout')
            ->name('scout.')
            ->group(function () {

                Route::get('/login', App\Livewire\Auth\Scout\Login::class)
                    ->name('login');

            });

    });