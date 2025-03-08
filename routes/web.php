<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/auth/player')
    ->name('auth.player.')
    ->group(function () {

        Route::get('/login', App\Livewire\Page\Auth\Player\Login::class)
            ->name('login');

        Route::get('/register', App\Livewire\Page\Auth\Player\Register::class)
            ->name('register');

        Route::get('/verify-email', App\Livewire\Page\Auth\Player\VerificationEmailNotice::class)
            ->name('verification.notice');
    });

Route::prefix('/auth/scout')
    ->name('auth.scout.')
    ->group(function () {

        Route::get('/login', App\Livewire\Page\Auth\Scout\Login::class)
            ->name('login');

        Route::get('/register', App\Livewire\Page\Auth\Scout\Register::class)
            ->name('register');

        Route::get('/verify-email', App\Livewire\Page\Auth\Scout\VerificationEmailNotice::class)
            ->name('verification.notice');
    });

Route::prefix('/auth/forgot-password')
    ->name('auth.password.')
    ->group(function () {

        Route::get('/', App\Livewire\Page\Auth\ForgotPasswordRequest::class)
            ->name('request');

    });