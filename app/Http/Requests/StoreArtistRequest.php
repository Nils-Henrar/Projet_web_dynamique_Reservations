<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreArtistRequest extends FormRequest
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
            'types' => 'sometimes|array', 
            'types.*' => 'exists:types,id',
        ];
    }
}
