<?php

namespace App\Http\Requests\Potential;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'village_code' => [
                'required',
                Rule::exists('indonesia_villages', 'code'),
            ],
            'name' => [
                'required'
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg',
            ],
            'potential-trixFields.content' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'village_code.required' => 'Desa harus diisi',
            'village_code.exists' => 'Desa tidak ditemukan',
            'name.required' => 'Nama tempat wisata harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg, png , jpg',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB',
            'potential-trixFields.content.required' => 'Konten harus diisi',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new CustomValidationException($validator);
    }
}