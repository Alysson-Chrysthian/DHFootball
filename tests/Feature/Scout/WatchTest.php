<?php

namespace Tests\Feature\Scout;

use App\Enums\Role;
use App\Enums\Status;
use App\Livewire\Page\Scout\Explore\Watch;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\ChooseContact;
use App\Notifications\Contact\DeleteContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class WatchTest extends TestCase
{
    use RefreshDatabase;

    protected $scout;
    protected $player;

    public function setUp(): void
    {
        parent::setUp();
        Notification::fake();

        Position::factory()->create();
        Club::factory()->create();
        $this->player = Player::factory()->create(['video' => 'video.mp4']);
        $this->scout = Scout::factory()->create();
    }

    public function test_can_render()
    {
        Livewire::test(Watch::class, ['id' => $this->player->id])
            ->assertStatus(200);
    }

    public function test_can_select_player()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        Livewire::test(Watch::class, ['id' => $this->player->id])
            ->call('selectPlayer');

        $this->assertEquals(
            Status::IN_ANALISYS->value, 
            ScoutPlayer::where('player_id', $this->player->id)->first()->status
        );
        Notification::assertSentTo($this->player, ChooseContact::class);
    }

    public function test_cannot_select_player_twice()
    {
        ScoutPlayer::create([
            'player_id' => $this->player->id,
            'scout_id' => $this->scout->id,
            'status' => Status::IN_ANALISYS->value,
        ]);

        Auth::guard(Role::SCOUT->value)->login($this->scout);

        Livewire::test(Watch::class, ['id' => $this->player->id])
            ->call('selectPlayer');

        $this->assertEquals(0, ScoutPlayer::count());
        Notification::assertSentTo($this->player, DeleteContact::class);
    }

}
