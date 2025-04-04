<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Events\SendMessage;
use App\Livewire\Components\Chat;
use App\Models\Chat as ModelsChat;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class ChatTest extends TestCase
{

    use RefreshDatabase;

    public $player, $scout, $contact;

    protected function setUp() : void {
        parent::setUp();

        Position::factory()->create();
        Club::factory()->create();

        $this->player = Player::factory()->create();
        $this->scout = Scout::factory()->create();
        $this->contact = ScoutPlayer::factory()->create([
            'scout_id' => $this->scout->id,
            'player_id' => $this->player->id,
        ]);
    }

    public function test_is_dispatching_send_message_event()
    {
        Event::fake();

        Livewire::test(Chat::class)
            ->set('role', Role::PLAYER->value)
            ->set('message', 'ola')
            ->set('contactId', $this->contact->id)
            ->call('sendMessage');

        Event::assertDispatched(SendMessage::class);
        $this->assertCount(1, ModelsChat::all());
    }

}
