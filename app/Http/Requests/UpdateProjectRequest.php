<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => [
                'required',
                'max:40',
                Rule::unique('projects')->ignore($this->project),
            ],
            'technologies_stack' => 'required|max:45',
            'description' => 'required|max:1000',
            'application_type' => [
                'required',
                Rule::in(['1', '2', '3']),
            ],
            'type_id' => 'nullable|exists:types,id',
            'project_img' => 'nullable|image',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Un progetto con lo stesso titolo è già presente',
            'title.max' => 'Per il titolo hai superato il limite di caratteri massimo consentito(:max)',
            'technologies_stack.required' => 'Inserire lo stack delle tecnologie del progetto è obbligatorio',
            'technologies_stack.max' => 'Per lo stack delle tecnologie hai superato il limite di caratteri massimo consentito(:max)',
            'description.required' => 'La descrizione è obbligatoria',
            'description.max' => 'Per la descrizione hai superato il limite di caratteri massimo consentito(:max)',
            'application_type.required' => 'Per il tipo di progetto è necessario selezionare una delle tre opzioni',
            'application_type.in' => 'Basta frugare nell\'inspector HACKER dei miei stivali',
            'project_img.image' => 'Il file caricato deve essere un\' immagine di un formato tra JPG, JPEG, PNG, BMP, GIF, SVG o WEBP',
            'type_id.exists' => 'Caro Mr Robot lascia stare l\'inspector',
            'technologies.exists' => 'Caro Mr Robot lascia stare le mie tecnologie'
        ];
    }
}
