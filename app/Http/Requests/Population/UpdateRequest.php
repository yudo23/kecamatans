<?php

namespace App\Http\Requests\Population;

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
            'total' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'village_code.required' => 'Desa harus diisi',
            'village_code.exists' => 'Desa tidak ditemukan',
            'total.required' => 'Total penduduk harus diisi',
            'total.numeric' => 'Total penduduk harus berupa angka',
            'total.min' => 'Total penduduk minimal 1',
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