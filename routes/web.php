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
                Route::get('/register', App\Livewire\Auth\Player\Register::class)
                    ->name('register');

            });

        Route::prefix('/scout')
            ->name('scout.')
            ->group(function () {

                Route::get('/login', App\Livewire\Auth\Scout\Login::class)
                    ->name('login');
                Route::get('/register', App\Livewire\Auth\Scout\Register::class)
                    ->name('register');

            });

    });