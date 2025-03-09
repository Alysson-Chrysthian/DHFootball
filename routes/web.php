<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/login', function () {
    throw new NotFoundHttpException();
})
    ->name('login');

Route::prefix('/auth/player')
    ->name('auth.player.')
    ->group(function () {

        Route::get('/login', App\Livewire\Page\Auth\Player\Login::class)
            ->name('login');

        Route::get('/register', App\Livewire\Page\Auth\Player\Register::class)
            ->name('register');

        Route::get('/verify-email', App\Livewire\Page\Auth\Player\VerificationEmailNotice::class)
            ->middleware('auth:players')
            ->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [AuthController::class, 'verifyPlayer'])
            ->middleware('auth:players')
            ->name('verification.verify');

        Route::get('/forgot-password/{id}/{hash}', App\Livewire\Page\Auth\Player\ResetPassword::class)
            ->middleware('guest:players')
            ->name('password.reset');
    });

Route::prefix('/auth/scout')
    ->name('auth.scout.')
    ->group(function () {

        Route::get('/login', App\Livewire\Page\Auth\Scout\Login::class)
            ->name('login');

        Route::get('/register', App\Livewire\Page\Auth\Scout\Register::class)
            ->name('register');

        Route::get('/verify-email', App\Livewire\Page\Auth\Scout\VerificationEmailNotice::class)
            ->middleware('auth:scouts')
            ->name('verification.notice');

        Route::get('/verify-email/{id}/{hash}', [AuthController::class, 'verifyScout'])
            ->middleware('auth:scouts')
            ->name('verification.verify');
        
        Route::get('/forgot-password/{id}/{hash}', App\Livewire\Page\Auth\Scout\ResetPassword::class)
            ->middleware('guest:scouts')
            ->name('password.reset');
    });

Route::prefix('/auth/forgot-password')
    ->name('auth.password.')
    ->group(function () {

        Route::get('/', App\Livewire\Page\Auth\ForgotPasswordRequest::class)
            ->name('request');

    });