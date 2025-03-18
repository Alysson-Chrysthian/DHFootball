<?php

namespace Tests\Feature\Player;

use Illuminate\Support\Str;
use App\Enums\Role;
use App\Http\Controllers\AuthController;
use App\Livewire\Page\Player\Profile;
use App\Models\Player;
use App\Models\Position;
use App\Models\UpdateEmailToken;
use App\Notifications\Profile\UpdatePlayerEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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

    public function test_can_send_update_email_notification()
    {
        Notification::fake();

        Livewire::test(Profile::class)
            ->set('email', 'test@gmail.com')
            ->call('updateEmail', $this->user, Role::PLAYER->value);

        $this->assertNotNull(UpdateEmailToken::where('old_email', $this->user->email)->first());
    }

    public function test_can_update_email()
    {
        $token = Str::random(60);
        $old_email = $this->user->email;
        $new_email = 'newemail@mail.com';
        $role = Role::PLAYER->value;

        UpdateEmailToken::factory()->create([
            'old_email' => $old_email,
            'new_email' => $new_email,
            'token' => $token,
            'role' => $role,
        ]);

        $authController = new AuthController;
        $authController->updatePlayerEmail($this->user->id, $token);

        $this->assertEquals('newemail@mail.com', Player::find($this->user->id)->email);
    }

}
