<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /**
         * @var \App\Models\User
         */

        $user = Auth::user();
        $role = $user->roles->first()->role;
        if ($role === 'admin') {
            return true;
        }


        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'types' => 'sometimes|array', // permet de vérifier que types est un tableau et qu'il est facultatif
            'types.*' => 'exists:types,id' // permet de vérifier que chaque élément du tableau types existe dans la table types, .* permet de valider chaque élément du tableau
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Le prénom est obligatoire.',
            'lastname.required' => 'Le nom est obligatoire.',
            'types.array' => 'La sélection des types est invalide.',
            'types.*.exists' => 'Le type sélectionné n\'existe pas.',
        ];
    }
}
