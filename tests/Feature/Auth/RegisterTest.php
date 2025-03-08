<?php

namespace Tests\Feature\Auth;

use App\Livewire\Page\Auth\Player\Register as PlayerRegister;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        if (!Position::count())
            Position::factory()->create();
    }

    public function test_can_register_with_all_fields_filled_succesfully()
    {
        Storage::fake('local');
        $avatar = UploadedFile::fake()->image('avatar.jpg');

        Livewire::test(PlayerRegister::class)
            ->set('email', 'mymail@mail.com')
            ->set('name', 'jondoe')
            ->set('password', 'mypassword')
            ->set('password_confirmation', 'mypassword')
            ->set('birthday', today()->subYears(17))
            ->set('avatar', $avatar)
            ->set('position', Position::first()->id)
            ->call('register');

        $this->assertDatabaseCount('players', 1);
        $this->assertAuthenticated('players');
    }

    public function test_can_register_with_null_avatar()
    {
        Livewire::test(PlayerRegister::class)
            ->set('email', 'mymail@mail.com')
            ->set('name', 'jon doe')
            ->set('password', 'mypassword')
            ->set('password_confirmation', 'mypassword')
            ->set('birthday', today()->subYears(17))
            ->set('avatar', null)
            ->set('position', Position::first()->id)
            ->call('register');

        $this->assertDatabaseCount('players', 1);
        $this->assertAuthenticated('players');
    }

    public function test_alerting_when_not_valid_credentials()
    {
        Livewire::test(PlayerRegister::class)
            ->call('register');
        
        $this->assertTrue(session()->has('alert'));
    }
}
