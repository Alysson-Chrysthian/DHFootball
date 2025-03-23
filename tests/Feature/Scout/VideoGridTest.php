<?php

namespace Tests\Feature\Scout;

use App\Enums\Age;
use App\Enums\Role;
use App\Enums\Status;
use App\Livewire\Components\VideoGrid;
use App\Models\Club;
use App\Models\Player;
use App\Models\Position;
use App\Models\Scout;
use App\Models\ScoutPlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class VideoGridTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void 
    {
        parent::setUp();
        Position::factory()->create(['id' => 1, 'name' => 'zagueiro']);
        Position::factory()->create(['id' => 2, 'name' => 'centro-avante']);
        Club::factory()->create();

        Storage::fake();

        $video1 = UploadedFile::fake()->create('video1.mp4', 10000, 'mp4');
        $video2 = UploadedFile::fake()->create('video2.mp4', 10000, 'mp4');

        Storage::put('videos/video1.mp4', file_get_contents($video1->getPathname()));
        Storage::put('videos/video2.mp4', file_get_contents($video2->getPathname()));

        Player::factory()->create([
            'position_id' => 1,
            'birthday' => Carbon::now()->subYears(17)->toDateTimeString(),
            'video' => 'videos/video1.mp4',
            'email' => Str::random(10) . '@gmail.com',
        ]);
        Player::factory()->create([
            'position_id' => 2,
            'birthday' => Carbon::now()->subYears(34)->toDateTimeString(),
            'video' => 'videos/video2.mp4',
            'email' => Str::random(10) . '@gmail.com',
        ]);

        $scout = Scout::factory()->create();
        Auth::guard(Role::SCOUT->value)->login($scout);
    }

    public function test_can_render()
    {
        $component = Livewire::test(VideoGrid::class);
        $players = $component->viewData('players');

        $this->assertCount(2, $players);
    }

    public function test_can_filter_by_position() 
    {
        $component = Livewire::test(VideoGrid::class)
            ->set('positionFilter', 1);

        $players = $component->viewData('players');

        $this->assertCount(1, $players);
    }

    public function test_can_filter_by_age()
    {
        $component = Livewire::test(VideoGrid::class)
            ->set('ageFilter', Age::THIRTY_TO_THIRTY_FIVE->value);

        $players = $component->viewData('players');

        $this->assertEquals(34, $players->first()->getAge());
    }

    public function test_can_paginate() 
    {
        for ($i = 0; $i < 20; $i++)
            Player::factory()->create([
                'email' => Str::random(10) . '@gmail.com',
                'video' => 'videos/video1.mp4'
            ]);

        $component = Livewire::test(VideoGrid::class)
            ->assertSee('Next')
            ->assertSee('Previous');

        $players = $component->viewData('players');

        $this->assertCount(16, $players);
    }

    public function test_can_paginate_with_filter()
    {

        for ($i = 0; $i < 10; $i++) {
            Player::factory()->create([
                'position_id' => 1,
                'email' => Str::random(10) . '@gmail.com',
                'video' => 'videos/video1.mp4'
            ]);
            Player::factory()->create([
                'position_id' => 2, 
                'email' => Str::random(10) . '@gmail.com',
                'video' => 'videos/video2.mp4'
            ]);
        }

        $component = Livewire::test(VideoGrid::class)
            ->set('positionFilter', 2)
            ->assertDontSee('Next')
            ->assertDontSee('Previous');

        $players = $component->viewData('players');

        $this->assertCount(11, $players);
    }

    public function test_is_not_returning_selected_players()
    {
        ScoutPlayer::factory()->create([
            'status' => Status::SELECTED->value,
        ]);

        $component = Livewire::test(VideoGrid::class);
        $players = $component->viewData('players');

        $this->assertCount(1, $players);
    }

}
