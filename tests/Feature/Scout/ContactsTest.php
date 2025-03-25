<?php

namespace Tests\Feature\Scout;

use App\Enums\Age;
use App\Enums\Role;
use App\Enums\Status;
use App\Livewire\Page\Scout\Chat\Contacts;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use App\Notifications\Contact\DeleteContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

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

}
