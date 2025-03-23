<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Player;
use App\Models\Scout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScoutPlayer>
 */
class ScoutPlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => Status::IN_ANALISYS->value,
            'player_id' => Player::all()->first(),
            'scout_id' => Scout::all()->first(),
        ];
    }
}
