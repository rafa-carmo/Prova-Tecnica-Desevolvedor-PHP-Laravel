<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
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
            'name' => "string|required|min:3",
            'cpf'=> "string|required|min:11|max:14",
            'email'=> "string|required|email",
            'birth_date' => "required|date",
            'nationality' => "required|string",
            'phones' => 'required|array',
            'phones.*' => 'required|string|min:9'
        ];
    }

    public function messages(): array {
        return [
            "name.require" => "The field name is requried",
            "cpf.require" => "The field cpf is requried",
            "email.require" => "The field email is requried",
            "birth_date.require" => "The field birth is requried",
            "nationality.require" => "The field nationality is requried",
            "phones.require" => "A phone is requried"

        ];
    }
}
