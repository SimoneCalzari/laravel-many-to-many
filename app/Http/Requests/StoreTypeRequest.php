<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'difficulty' => 'required|max:20|unique:types',
            'is_team_project' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'difficulty.required' => 'La difficoltà è obbligatoria',
            'difficulty.max' => 'La difficoltà deve essere al massimo di :max caratteri',
            'difficulty.unique' => 'Esiste una difficoltà con lo stesso nome, riprova',
            'is_team_project.required' => 'Specificare se è un progetto di team o individuale è obbligatorio',
            'is_team_project.boolean' => 'Basta Mr Robot, lascia stare l\'inspector'
        ];
    }
}
