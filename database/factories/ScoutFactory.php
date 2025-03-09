<?php

namespace Database\Factories;

use App\Models\Club;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scout>
 */
class ScoutFactory extends Factory
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
            'password' => Hash::make('mypassword'),
            'club_id' => Club::first()->id,
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
