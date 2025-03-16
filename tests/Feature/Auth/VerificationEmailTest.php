<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\AuthController;
use App\Livewire\Page\Auth\Player\VerificationEmailNotice as PlayerVerificationEmailNotice;
use App\Livewire\Page\Auth\Scout\VerificationEmailNotice as ScoutVerificationEmailNotice;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Notifications\Verification\VerifyPlayerEmail;
use App\Notifications\Verification\VerifyScoutEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class VerificationEmailTest extends TestCase
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

    public function test_can_send_player_verification_email() 
    {
        Notification::fake();

        $player = Player::first();

        if (!$player) {
            Player::factory()->unverified()
                ->create();
            $player = Player::first();
        }

        Auth::guard('players')->login($player);

        Livewire::test(PlayerVerificationEmailNotice::class);
        Notification::assertSentTo([$player], VerifyPlayerEmail::class);
    }
    
    public function test_can_send_scout_verification_email() 
    {
        Notification::fake();

        $scout = Scout::first();

        if (!$scout) {
            Scout::factory()->unverified()
                ->create();
            $scout = Scout::first();
        }

        Auth::guard('scouts')->login($scout);

        Livewire::test(ScoutVerificationEmailNotice::class);
        Notification::assertSentTo([$scout], VerifyScoutEmail::class);
    }

    public function test_is_alerting_when_player_already_verified()
    {   
        Notification::fake();

        $player = Player::first();

        if (!$player) {
            Player::factory()->create();
            $player = Player::first();
        }
        
        Auth::guard('players')->login($player);

        Livewire::test(PlayerVerificationEmailNotice::class);
        
        Notification::assertNothingSent();
    }

    public function test_is_alerting_when_scout_already_verified()
    {
        Notification::fake();

        $scout = Scout::first();

        if (!$scout) {
            Scout::factory()->create();
            $scout = Scout::first();
        }
        
        Auth::guard('scouts')->login($scout);

        Livewire::test(ScoutVerificationEmailNotice::class);
        
        Notification::assertNothingSent();
    }

    public function test_can_verify_player_email()
    {
        Player::factory()->unverified()
            ->create();

        $player = Player::where('email_verified_at', null)->first();

        $authController = new AuthController;
        $authController->verifyPlayer($player->id, sha1($player->email));

        $player = Player::find($player->id);

        $this->assertNotNull($player->email_verified_at);
    }

    public function test_can_verify_scout_email()
    {
        Scout::factory()->unverified()
            ->create();

        $scout = Scout::where('email_verified_at', null)->first();

        $authController = new AuthController;
        $authController->verifyScout($scout->id, sha1($scout->email));

        $scout = Scout::find($scout->id);

        $this->assertNotNull($scout->email_verified_at);
    }

    public function test_is_not_verifing_when_already_verified()
    {
        Player::factory()->create();
        $player = Player::whereNot('email_verified_at', null)->first();

        $authController = new AuthController;
        $authController->verifyPlayer($player->id, sha1($player->email));

        $this->assertTrue(session()->has('alert'));
    }

}
