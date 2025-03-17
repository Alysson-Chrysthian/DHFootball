<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'aly',
            'email' => 'alyssonchrysthian@gmail.com',
            'birthday' => today()->subYears(17),
            'position_id' => Position::first()->id,
            'password' => Hash::make('mypassword'),
            'avatar' => null,
            'email_verified_at' => now(),
        ];
    }

    public function unverified()
    {
        return $this->state(fn ($attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
