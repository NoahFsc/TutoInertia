<?php

declare(strict_types=1);

namespace App\Domain\Shared\Models;

use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Role $role
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Logement|null $logement
 */
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
// Implémenter Illuminate\Contracts\Auth\MustVerifyEmail pour rendre la vérification d'e-mail obligatoire.
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class,
        ];
    }

    public function estBailleur(): bool
    {
        return $this->role === Role::Bailleur;
    }

    public function estLocataire(): bool
    {
        return $this->role === Role::Locataire;
    }

    /**
     * @return HasMany<Logement, $this>
     */
    public function logements(): HasMany
    {
        return $this->hasMany(Logement::class, 'proprietaire_id');
    }

    /**
     * Le logement occupé par ce locataire, s'il en a un.
     *
     * @return HasOne<Logement, $this>
     */
    public function logement(): HasOne
    {
        return $this->hasOne(Logement::class, 'locataire_id');
    }

    // Obligatoire ici : le modèle n'est pas dans app/Models,
    // Laravel ne peut donc pas deviner sa factory.
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
