<?php

namespace Tests\Feature\Player;

use App\Enums\Role;
use App\Enums\Status;
use App\Livewire\Page\Player\Chat\Contacts;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class ContactsTest extends TestCase
{

    use RefreshDatabase;

    public $scout, $player;

    public function setUp() : void 
    {
        parent::setUp();
        
        Position::factory()->create();
        $this->player = Player::factory()->create();

        Club::factory()->create(['id' => 1, 'name' => 'palmeiras', 'icon' => 'palmeiras.png']);
        Club::factory()->create(['id' => 2, 'name' => 'flamengo', 'icon' => 'flamengo.png']);
        $this->scout =  Scout::factory()->create(['club_id' => 1]);
    
        ScoutPlayer::factory()->create([
            'player_id' => $this->player->id,
            'scout_id' => $this->scout->id,
            'status' => Status::IN_ANALISYS->value,
        ]);
    }

    public function test_can_get_club_icon()
    {
        $this->assertEquals('palmeiras.png', $this->scout->getClubIcon());
    }

    public function test_query_for_contacts_is_working()
    {
        Auth::guard(Role::PLAYER->value)->login($this->player);

        Livewire::test(Contacts::class)
            ->assertStatus(200);
    }

    public function test_is_searching_by_name()
    {
        Auth::guard(Role::PLAYER->value)->login($this->player);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'aly');
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'not a name');
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

    public function test_is_searching_by_club()
    {
        Auth::guard(Role::PLAYER->value)->login($this->player);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'pal');
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('search', 'not a club');
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

    public function test_is_filtering_by_club()
    {
        Auth::guard(Role::PLAYER->value)->login($this->player);

        $component = Livewire::test(Contacts::class)
            ->set('clubFilter', Club::where('name', 'palmeiras')->first()->id);
        $contacts = $component->viewData('contacts');

        $this->assertCount(1, $contacts);

        $component = Livewire::test(Contacts::class)
            ->set('clubFilter', Club::where('name', 'flamengo')->first()->id);
        $contacts = $component->viewData('contacts');

        $this->assertCount(0, $contacts);
    }

}
