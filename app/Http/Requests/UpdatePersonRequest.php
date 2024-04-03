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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'required', 'string'],
            'second_name' => ['sometimes', 'string', 'nullable'],
            'first_surname' => ['sometimes', 'required', 'string'],
            'second_surname' => ['sometimes', 'string', 'nullable'],
            'married_surname' => ['sometimes', 'string', 'nullable'],
            'document_type' => ['sometimes', 'required', 'string', 'in:CUI,PASSPORT'],
            'file' => ['sometimes', 'mimes:pdf', 'max:1024', 'nullable'],
            'birthdate' => ['sometimes', 'date', 'nullable'],
            'phone_number' => ['sometimes', 'string', 'nullable'],
            'email' => ['sometimes', 'email', 'nullable'],
            'gender' => ['sometimes', 'required', 'string', 'in:MALE,FEMALE'],
            'civil_status' => ['sometimes', 'required', 'string', 'in:SINGLE,MARRIED,DIVORCED,WIDOWED'],
            'address' => ['sometimes', 'string', 'nullable'],
        ];
    }

    public function prepareForValidation(): void
    {
        $toMerge = [];

        if ($this->hasFile('file')) {
            $file = $this->file('file');
            $filepath = $file->store('uploads', 'public');

            $toMerge['document'] = $filepath;
        }

        $this->merge($toMerge);
    }
}
