<?php

namespace Database\Seeders;

use App\Domain\Logement\Models\Logement;
use App\Domain\Shared\Enums\Role;
use App\Domain\Shared\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as RoleModel;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (Role::cases() as $role) {
            RoleModel::findOrCreate($role->value);
        }

        $bailleur = User::factory()->bailleur()->create([
            'name' => 'Bernard Bailleur',
            'email' => 'bailleur@mini-bail.test',
        ]);

        $locataire = User::factory()->locataire()->create([
            'name' => 'Léa Locataire',
            'email' => 'locataire@mini-bail.test',
        ]);

        Logement::factory()->count(5)->for($bailleur, 'proprietaire')->create();
        Logement::factory()->occupe()->for($bailleur, 'proprietaire')->for($locataire, 'locataire')->create();
        Logement::factory()->occupe()->for($bailleur, 'proprietaire')->create();
    }
}
