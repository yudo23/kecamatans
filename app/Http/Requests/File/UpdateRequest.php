<?php

namespace App\Http\Requests\File;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'file' => [
                'nullable',
                'file',
                'max:2048',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama file harus diisi',
            'file.file' => 'File tidak valid',
            'file.max' => 'File tidak boleh lebih dari 2MB',
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