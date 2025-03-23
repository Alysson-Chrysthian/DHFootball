<?php

use App\Http\Controllers\AuthController;
use App\Models\Player;
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

        Route::get('/forgot-password/{token}', App\Livewire\Page\Auth\Player\ResetPassword::class)
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
        
        Route::get('/forgot-password/{token}', App\Livewire\Page\Auth\Scout\ResetPassword::class)
            ->name('password.reset');
    });

Route::prefix('/auth/forgot-password')
    ->name('auth.password.')
    ->group(function () {

        Route::get('/', App\Livewire\Page\Auth\ForgotPasswordRequest::class)
            ->name('request');
        
    });

Route::prefix('/player')
    ->name('player.')
    ->middleware(['auth:players', 'verified'])
    ->group(function () {

        Route::get('/profile', App\Livewire\Page\Player\Profile::class)
            ->name('profile');

        Route::get('/chat', App\Livewire\Page\Player\Chat\Contacts::class)
            ->name('chat');

    });

Route::prefix('/scout')
    ->name('scout.')
    ->middleware(['auth:scouts', 'verified'])
    ->group(function () {

        Route::get('/profile', App\Livewire\Page\Scout\Profile::class)
            ->name('profile');

        Route::get('/explore', App\Livewire\Page\Scout\Explore\ForYou::class)
            ->name('explore');
        Route::get('/explore/watch/{id}', App\Livewire\Page\Scout\Explore\Watch::class)
            ->name('watch');

        Route::get('/chat', App\Livewire\Page\Scout\Chat\Contacts::class)
            ->name('contacts');

    });