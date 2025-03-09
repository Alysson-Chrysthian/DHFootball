<?php

namespace Tests\Feature\Auth;

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
        $this->assertTrue(session()->has('alert'));
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
        $this->assertTrue(session()->has('alert'));
    }

}
