# `app/Domain` — le métier, sans HTTP

Tout ce qui est _métier_ vit ici, rangé par domaine (`Logement/`, `Bail/`, `Finance/`…) puis par
type de classe (`Models/`, `Actions/`, `Data/`, `Enums/`, `Events/`, `Exceptions/`…).
`Shared/` contient ce qui appartient à tous les domaines : `User`, les enums transverses, les value objects.

## La règle unique

**Rien dans `app/Domain` ne connaît HTTP.** Pas de `request()`, pas de `auth()`, pas de `redirect()`,
pas de `session()`. Une Action reçoit des objets (un `User`, un modèle, un DTO), jamais une requête.

C'est ce qui permet d'appeler la même Action depuis un contrôleur, une commande Artisan, un job ou un test
unitaire, sans rien simuler.

## Comment la logique circule

```
Route → FormRequest (validation)
      → Controller (3 à 8 lignes)
      → Action (orchestration métier, transaction)
          → Services / ValueObjects (calculs purs)
          → Models (persistance)
          → Event (effets de bord : mails, PDF, log)
      → Inertia::render(props typées depuis un DTO)
```

## Ce qu'on ne fait pas

- Pas de Repository tant qu'une requête n'est pas réellement complexe : Eloquent est le domaine.
- Pas d'interface tant qu'une seule implémentation existe.
- Pas de DTO géant qui servirait partout : un DTO par contexte (entrée d'un formulaire, affichage d'une liste, affichage d'une fiche).

## Un modèle hors de `app/Models`

`User` est ici, pas dans `app/Models` : Laravel ne fait aucune hypothèse sur l'emplacement des classes,
seul l'autoload PSR-4 compte. Deux conséquences à ne pas oublier pour chaque nouveau modèle :

- `config/auth.php` (pour `User`) ou toute référence `App\Models\…` doit pointer sur le nouveau namespace ;
- le modèle doit déclarer `newFactory()` et la factory déclarer `$model`, sinon `Model::factory()` ne trouve pas sa classe.
