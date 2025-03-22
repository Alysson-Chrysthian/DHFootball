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
use Mockery;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
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
        Storage::fake();

        $ffmpegMock = Mockery::mock('alias:' . FFMpeg::class);

        $ffmpegMock->shouldReceive(
            'fromDisk', 
            'open', 
            'getFrameFromSeconds',
            'export',
            'toDisk',
            'save', 
        )->andReturnSelf();

        $this->app->instance(FFMpeg::class, $ffmpegMock);
    
        Livewire::test(Profile::class)
            ->set('video', UploadedFile::fake()->create('video.mp4', 10000, 'mp4'))
            ->call('updateVideo', $this->user);

        $this->user->fresh();

        $this->assertNotNull($this->user->video);
        $this->assertNotNull($this->user->thumbnail);

    }

    public function test_can_delete_video()
    {
        Storage::fake();

        Player::where('video', null)->delete();

        $video = UploadedFile::fake()->create('video.mp4', 10000, 'mp4');
        $thumbnail = UploadedFile::fake()->image('image.png');

        Storage::put('videos/video.mp4', file_get_contents($video->getPathname()));
        Storage::put('thumbnails/image.png', file_get_contents($thumbnail->getPathname()));

        Player::factory()->create([
            'video' => 'videos/video.mp4',
            'thumbnail' => 'thumbnails/image.png',
        ]);

        $player = Player::whereNot('video', null)->first();

        Auth::guard(Role::PLAYER->value)->login($player);
    
        Livewire::test(Profile::class)
            ->call('deleteVideo');
        
        $player->fresh();

        $this->assertNull($player->video);
        $this->assertNull($player->thumbnail);
        
        Storage::assertMissing('videos/video.mp4');
        Storage::assertMissing('thumbnails/image.png');
    }

    public function test_is_not_throwing_an_error_when_file_not_exists()
    {
        $this->expectNotToPerformAssertions();

        Auth::guard(Role::PLAYER->value)->login($this->user);

        Livewire::test(Profile::class)
            ->call('deleteVideo');    
    }

}
