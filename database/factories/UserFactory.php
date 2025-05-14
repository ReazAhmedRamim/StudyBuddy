<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => User::ROLE_STUDENT,
            'approval_status' => User::STATUS_APPROVED, // ✅ fixed
            'phone' => $this->faker->phoneNumber(),
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'profile_photo' => null,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // Role States
    public function admin(): static
    {
        return $this->state([
            'role' => User::ROLE_ADMIN,
            'approval_status' => User::STATUS_APPROVED
        ]);
    }

    public function tutor(): static
    {
        return $this->state([
            'role' => User::ROLE_TUTOR,
            'approval_status' => User::STATUS_APPROVED
        ]);
    }

    public function student(): static
    {
        return $this->state([
            'role' => User::ROLE_STUDENT,
            'approval_status' => User::STATUS_APPROVED
        ]);
    }

    // Status States
    public function pending(): static
    {
        return $this->state([
            'approval_status' => User::STATUS_PENDING
        ]);
    }

    public function approved(): static
    {
        return $this->state([
            'approval_status' => User::STATUS_APPROVED
        ]);
    }

    public function banned(): static
    {
        return $this->state([
            'approval_status' => User::STATUS_BANNED
        ]);
    }

    // Special Combinations
    public function pendingTutor(): static
    {
        return $this->state([
            'role' => User::ROLE_TUTOR,
            'approval_status' => User::STATUS_PENDING
        ]);
    }

    public function bannedStudent(): static
    {
        return $this->state([
            'role' => User::ROLE_STUDENT,
            'approval_status' => User::STATUS_BANNED
        ]);
    }
}
