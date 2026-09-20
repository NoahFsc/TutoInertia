<?php

declare(strict_types=1);

namespace App\Domain\Logement\Models;

use App\Domain\Intervention\Models\DemandeTravaux;
use App\Domain\Logement\Enums\StatutLogement;
use App\Domain\Shared\Models\User;
use Database\Factories\LogementFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $adresse
 * @property int $surface
 * @property int $loyer_cents
 * @property StatutLogement $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $proprietaire_id
 * @property int|null $locataire_id
 * @property-read User $proprietaire
 * @property-read User|null $locataire
 */
class Logement extends Model
{
    /** @use HasFactory<LogementFactory> */
    use HasFactory;

    protected $fillable = ['adresse', 'surface', 'loyer_cents', 'statut', 'proprietaire_id', 'locataire_id'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return ['statut' => StatutLogement::class];
    }

    /**
     * @return HasMany<DemandeTravaux, $this>
     */
    public function demandesTravaux(): HasMany
    {
        return $this->hasMany(DemandeTravaux::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function locataire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'locataire_id');
    }

    // Obligatoire ici : le modèle n'est pas dans app/Models,
    // Laravel ne peut donc pas deviner sa factory.
    protected static function newFactory(): LogementFactory
    {
        return LogementFactory::new();
    }
}
