<?php

namespace Tests\Feature\Scout;

use App\Enums\Role;
use App\Http\Controllers\AuthController;
use App\Livewire\Page\Scout\Profile;
use App\Models\Club;
use App\Models\Scout;
use App\Models\UpdateEmailToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Str;

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

        $this->assertEquals($this->user->club_id, $club->id);
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

    public function test_can_send_update_email_notification()
    {
        Notification::fake();

        Livewire::test(Profile::class)
            ->set('email', 'test@gmail.com')
            ->call('updateEmail', $this->user, Role::SCOUT->value);

        $this->assertNotNull(UpdateEmailToken::where('old_email', $this->user->email)->first());
    }

    public function test_can_update_email()
    {
        $token = Str::random(60);
        $old_email = $this->user->email;
        $new_email = 'newemail@mail.com';
        $role = Role::SCOUT->value;

        UpdateEmailToken::factory()->create([
            'old_email' => $old_email,
            'new_email' => $new_email,
            'token' => $token,
            'role' => $role,
        ]);

        $authController = new AuthController;
        $authController->updateScoutEmail($this->user->id, $token);

        $this->assertEquals('newemail@mail.com', Scout::find($this->user->id)->email);
    }

}
