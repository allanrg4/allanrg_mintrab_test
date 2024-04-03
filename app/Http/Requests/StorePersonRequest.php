<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'second_name' => ['string', 'nullable'],
            'first_surname' => ['required', 'string'],
            'second_surname' => ['string', 'nullable'],
            'married_surname' => ['string', 'nullable'],
            'document_type' => ['required', 'string', 'in:CUI,PASSPORT'],
            'file' => ['mimes:pdf', 'max:1024', 'nullable'],
            'birthdate' => ['date', 'nullable'],
            'phone_number' => ['string', 'nullable'],
            'email' => ['email', 'nullable'],
            'gender' => ['required', 'string', 'in:MALE,FEMALE'],
            'civil_status' => ['required', 'string', 'in:SINGLE,MARRIED,DIVORCED,WIDOWED'],
            'address' => ['string', 'nullable'],
        ];
    }

    public function prepareForValidation(): void
    {
        $toMerge = ['user_id' => auth()->id()];

        if ($this->hasFile('file')) {
            $file = $this->file('file');
            $filepath = $file->store('uploads', 'public');

            $toMerge['document'] = $filepath;
        }

        $this->merge($toMerge);
    }
}
