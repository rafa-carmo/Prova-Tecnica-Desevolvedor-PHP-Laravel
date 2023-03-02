<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => "string|nullable|min:3",
            'cpf'=> "string|nullable|min:11|max:14",
            'email'=> "string|nullable|email",
            'birth_date' => "nullable|date",
            'nationality' => "nullable|string"
        ];
    }
}
