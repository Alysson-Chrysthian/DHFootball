<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UpdateEmailToken>
 */
class UpdateEmailTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'old_email' => 'oldemail@mail.com',
            'new_email' => 'newemail@mail.com',
            'token' => Str::random(60),
            'role' => Role::PLAYER->value,
        ];
    }
}
