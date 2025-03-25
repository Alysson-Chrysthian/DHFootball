<?php

namespace Tests\Feature\Scout;

use App\Enums\Age;
use App\Enums\Role;
use App\Enums\Status;
use App\Http\Controllers\ContactController;
use App\Livewire\Page\Scout\Chat\Contacts;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\DeleteContact;
use App\Notifications\Contact\PlayerAcceptYourRequest;
use App\Notifications\Contact\PlayerSelectedByOtherScout;
use App\Notifications\Contact\RequestChangeStatusToPlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Str;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    public $player;
    public $scout;
    public $contact;

    public function setUp() : void 
    {
        parent::setUp();

        Position::factory()->create(['name' => 'zagueiro']);
        Position::factory()->create(['name' => 'centro-avante']);
        
        Club::factory()->create();
        $this->player = Player::factory()->create(['name' => 'alysson']);
        $this->scout = Scout::factory()->create();
        $this->contact = ScoutPlayer::factory()->create();
    }

    public function test_query_for_contacts_is_working()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        Livewire::test(Contacts::class)
            ->assertStatus(200);
    }

    public function test_query_is_searching_for_contacts_by_position()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        $component = Livewire::test(Contacts::class)
            ->set('positionFilter', Position::where('name', 'zagueiro')->first()->id);
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('positionFilter', Position::where('name', 'centro-avante')->first()->id);
        $contacts = $component->viewData('contacts');
    
        $this->assertCount(0, $contacts);
    }

    public function test_is_searching_by_name()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'aly');
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'not a name');
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

    public function test_is_searching_by_position()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'zag');
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'not a pos');
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

    public function test_is_filtering_by_age()
    {
        Auth::guard(Role::SCOUT->value)->login($this->scout);

        $component = Livewire::test(Contacts::class)
            ->set('ageFilter', Age::FIFTEEN_TO_TWENTY->value);
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('ageFilter', Age::THIRTY_TO_THIRTY_FIVE->value);
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

    public function test_can_delete_contact()
    {
        Notification::fake();

        Livewire::test(Contacts::class)
            ->set('selectedStatus.' . $this->contact->id, Status::DELETE->value)
            ->call('changeStatus', $this->contact->toArray());

        $this->assertCount(0, ScoutPlayer::all());
        Notification::assertSentTo($this->player, DeleteContact::class);
    }

    public function test_can_send_request_to_select_player()
    {
        Notification::fake();

        Livewire::test(Contacts::class)
            ->set('selectedStatus.' . $this->contact->id, Status::SELECTED->value)
            ->call('changeStatus', $this->contact->toArray());

        Notification::assertSentTo($this->player, RequestChangeStatusToPlayer::class);
    }

    public function test_player_can_accept_request_to_be_selected()
    {
        Notification::fake();

        for ($i = 0; $i < 10; $i++) {
            $scout = Scout::factory()->create([
                'email' => Str::random(10) . '@gmail.com',
            ]);
            $player = Player::factory()->create([
                'email' => Str::random(10) . '@gmail.com',
            ]);
            ScoutPlayer::factory()->create([
                'scout_id' => $scout->id,
                'player_id' => $player->id,
                'status' => Status::IN_ANALISYS->value,
            ]);
        }

        $contactController = new ContactController;
        $contactController->changePlayerStatusToSelected($this->contact->id, sha1($this->player->email));

        $contact = ScoutPlayer::find($this->contact->id);

        Notification::assertSentTimes(PlayerSelectedByOtherScout::class, 10);
        Notification::assertSentTo($this->scout, PlayerAcceptYourRequest::class);
        Notification::assertNotSentTo($this->scout, PlayerSelectedByOtherScout::class);

        $this->assertEquals(Status::SELECTED->value, $contact->status);
        $this->assertCount(1, ScoutPlayer::where('player_id', $this->player->id)->get());
    }

}
