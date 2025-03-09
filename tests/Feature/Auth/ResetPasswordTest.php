<?php

namespace Tests\Feature\Auth;

use App\Livewire\Page\Auth\ForgotPasswordRequest;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Notifications\Password\ResetPlayerPassword;
use App\Notifications\Password\ResetScoutPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
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


    public function test_can_send_reset_password_email_to_player()
    {
        Notification::fake();

        $player = Player::factory()->create();

        Livewire::test(ForgotPasswordRequest::class)
            ->set('role', 'players')
            ->set('email', $player->email)
            ->call('send');
            
        Notification::assertSentTo($player, ResetPlayerPassword::class);
    }

    public function test_can_send_reset_password_email_to_scout()
    {
        Notification::fake();

        $scout = Scout::factory()->create();

        Livewire::test(ForgotPasswordRequest::class)
            ->set('role', 'scouts')
            ->set('email', $scout->email)
            ->call('send');

        Notification::assertSentTo($scout, ResetScoutPassword::class);
    }

    public function test_is_not_sending_when_email_not_exists()
    {
        Notification::fake();

        Livewire::test(ForgotPasswordRequest::class)
            ->set('role', 'players')
            ->set('email', 'notexistentemail@mail.com')
            ->call('send');

        Notification::assertNothingSent();
    }

}
