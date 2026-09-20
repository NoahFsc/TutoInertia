<?php

namespace Database\Factories;

use App\Domain\Shared\Enums\Role;
use App\Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as RoleModel;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function bailleur(): static
    {
        return $this->avecRole(Role::Bailleur);
    }

    public function locataire(): static
    {
        return $this->avecRole(Role::Locataire);
    }

    protected function avecRole(Role $role): static
    {
        return $this->afterCreating(function (User $user) use ($role): void {
            RoleModel::findOrCreate($role->value);

            $user->assignRole($role->value);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
