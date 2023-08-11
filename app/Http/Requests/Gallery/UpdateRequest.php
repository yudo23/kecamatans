<?php

namespace App\Http\Requests\Gallery;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'image' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama foto harus diisi',
            'image.image' => 'Foto harus berupa gambar',
            'image.mimes' => 'Foto harus berupa jpeg, png , jpg',
            'image.max' => 'Foto tidak boleh lebih dari 2MB',
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