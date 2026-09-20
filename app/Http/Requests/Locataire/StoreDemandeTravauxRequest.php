<?php

declare(strict_types=1);

namespace App\Http\Requests\Locataire;

use App\Domain\Intervention\Enums\Urgence;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDemandeTravauxRequest extends FormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'min:20'],
            'urgence' => ['required', Rule::enum(Urgence::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'description.min' => 'Décrivez le problème en au moins 20 caractères.',
        ];
    }
}
