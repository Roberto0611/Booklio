<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        // Primero generamos el nombre aleatorio
        $name = fake()->name(); // Usamos fake() o $this->faker->name()

        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            // Campos adicionales:
            'photo' => 'https://placehold.co/200x200/2563EB/FFFFFF?text=' . strtoupper(substr($name, 0, 1)),
            'bio' => fake()->sentence(rand(8, 15)),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // Estado personalizado para bios largas
    public function withLongBio(): static
    {
        return $this->state(fn (array $attributes) => [
            'bio' => fake()->paragraph(3),
        ]);
    }
}
