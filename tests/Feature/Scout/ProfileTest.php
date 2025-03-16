<?php

namespace Tests\Feature\Scout;

use App\Enums\Role;
use App\Livewire\Page\Scout\Profile;
use App\Models\Club;
use App\Models\Scout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp() : void
    {
        parent::setUp();

        Club::factory()->create([
            'name' => 'flamengo',
            'icon' => 'flamengo.png',
        ]);
        Club::factory()->create([
            'name' => 'palmeiras',
            'icon' => 'palmeiras.png',
        ]);

        Scout::factory()->create();

        $this->user = Scout::first();
        Auth::guard(Role::SCOUT->value)->login($this->user);
    }

    public function test_can_update_name()
    {   
        Livewire::test(Profile::class)
            ->set('name', 'alysson')
            ->call('updateName', $this->user);

        $this->user->fresh();

        $this->assertEquals('alysson', $this->user->name);
    }

    public function test_can_update_club()
    {
        $club = Club::where('name', 'palmeiras')->first();

        Livewire::test(Profile::class)
            ->set('club', $club->id)
            ->call('updateClub', $this->user);

        $this->user->fresh();

        $this->assertEquals($club->id, $this->user->club_id);
    }

    public function test_can_update_avatar()
    {
        Storage::fake('local');

        $avatar = UploadedFile::fake()->image('profile.png');

        Livewire::test(Profile::class)
            ->set('avatar', $avatar)
            ->call('updateAvatar', $this->user);

        $this->user->fresh();

        $this->assertNotNull($this->user->avatar);
    }

}
