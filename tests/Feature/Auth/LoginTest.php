<?php

namespace Tests\Feature\Auth;

use App\Livewire\Form\Login;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        if (!Position::count())
            Position::factory()->create();
        if (!Club::count())
            Club::factory()->create();
    }

    public function test_can_login_as_player() 
    {
        Player::factory()->create([
            'password' => Hash::make('mypassword')
        ]);
        $player = Player::first();

        Livewire::test(Login::class)
            ->set('guard', 'players')
            ->set('email', $player->email)
            ->set('password', 'mypassword')
            ->call('login');
        
        $this->assertAuthenticated('players');
    }

    public function test_can_login_as_scout()
    {
        Scout::factory()->create([
            'password' => Hash::make('mypassword')
        ]);
        $scout = Scout::first();

        Livewire::test(Login::class)
            ->set('guard', 'scouts')
            ->set('email', $scout->email)
            ->set('password', 'mypassword')
            ->call('login');

        $this->assertAuthenticated('scouts');
    }

}
