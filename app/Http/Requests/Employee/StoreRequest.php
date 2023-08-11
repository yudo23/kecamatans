<?php

namespace App\Http\Requests\Employee;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'position' => ['required'],
            'image' => [
                'required',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama pegawai harus diisi',
            'position.required' => 'Jabatan pegawai harus diisi',
            'image.required' => 'Foto pegawai harus diisi',
            'image.image' => 'Foto pegawai harus berupa gambar',
            'image.mimes' => 'Foto pegawai harus berupa jpeg, png , jpg',
            'image.max' => 'Foto pegawai tidak boleh lebih dari 2MB',
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