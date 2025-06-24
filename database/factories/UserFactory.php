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
        return [
            'title' => $this->faker->randomElement(['Mr.', 'Mrs.', 'Ms.', 'Dr.']),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->optional(0.3)->firstName(), // 30% chance of middle name
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'cohort' => 'Cohort ' . $this->faker->numberBetween(2020, 2025),
            'email_address' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'is_active' => true,
            'created_by' => 'system_seeder',
            'remember_token' => Str::random(10),
        ];
    }
}