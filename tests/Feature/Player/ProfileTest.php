<?php

namespace Tests\Feature\Player;

use App\Enums\Role;
use App\Livewire\Page\Player\Profile;
use App\Models\Player;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp() : void {
        parent::setUp();

        Position::factory()->create([
            'name' => 'zagueiro',
        ]);
        Position::factory()->create([
            'name' => 'centro-avante',
        ]);
        Player::factory()->create();
    
        $this->user = Player::first();
        Auth::guard(Role::PLAYER->value)->login($this->user);
    }

    public function test_can_update_name()
    {
        Livewire::test(Profile::class)
            ->set('name', 'alysson')
            ->call('updateName', $this->user);

        $this->user->fresh();

        $this->assertEquals('alysson', $this->user->name);
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

    public function test_can_update_position()
    {
        $position = Position::first();

        Livewire::test(Profile::class)
            ->set('position', $position->id)
            ->call('updatePosition', $this->user);

        $this->user->fresh();

        $this->assertEquals($position->id, $this->user->position_id);
    }

    public function test_can_update_video()
    {
        Storage::fake('local');

        $video = UploadedFile::fake()->create('video.mp4', 50*1024, 'mp4');

        Livewire::test(Profile::class)
            ->set('video', $video)
            ->call('updateVideo', $this->user);

        $this->user->fresh();

        $this->assertNotNull($this->user->video);
    }

}
