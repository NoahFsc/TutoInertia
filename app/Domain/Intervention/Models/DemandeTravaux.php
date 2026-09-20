<?php

declare(strict_types=1);

namespace App\Domain\Intervention\Models;

use App\Domain\Intervention\Enums\StatutDemande;
use App\Domain\Intervention\Enums\Urgence;
use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Models\User;
use Database\Factories\DemandeTravauxFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $logement_id
 * @property int $auteur_id
 * @property string $titre
 * @property string $description
 * @property Urgence $urgence
 * @property StatutDemande $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Logement $logement
 * @property-read User $auteur
 */
class DemandeTravaux extends Model
{
    /** @use HasFactory<DemandeTravauxFactory> */
    use HasFactory;

    // Laravel déduirait « demande_travauxes ».
    protected $table = 'demande_travaux';

    protected $fillable = ['logement_id', 'auteur_id', 'titre', 'description', 'urgence', 'statut'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'urgence' => Urgence::class,
            'statut' => StatutDemande::class,
        ];
    }

    /**
     * @return BelongsTo<Logement, $this>
     */
    public function logement(): BelongsTo
    {
        return $this->belongsTo(Logement::class);
    }

    /**
     * Le second argument est nécessaire : la colonne ne s'appelle pas user_id.
     *
     * @return BelongsTo<User, $this>
     */
    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    // Obligatoire ici : le modèle n'est pas dans app/Models,
    // Laravel ne peut donc pas deviner sa factory.
    protected static function newFactory(): DemandeTravauxFactory
    {
        return DemandeTravauxFactory::new();
    }
}
