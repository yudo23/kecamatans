<?php

namespace App\Http\Requests\Setting;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LandingPageSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
            ],
            'logo' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'favicon' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'head_of_office' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'footer' => [
                'required',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi.',
            'logo.image' => 'Logo harus berupa gambar',
            'logo.mimes' => 'Logo harus berupa jpeg,png,jpg,svg',
            'logo.max' => 'Logo tidak boleh lebih dari 2MB',
            'favicon.image' => 'Favicon harus berupa gambar',
            'favicon.mimes' => 'Favicon harus berupa jpeg,png,jpg,svg',
            'favicon.max' => 'Favicon tidak boleh lebih dari 2MB',
            'head_of_office_image.mimes' => 'Foto camat harus berupa jpeg,png,jpg,svg',
            'head_of_office_image.max' => 'Foto camat tidak boleh lebih dari 2MB',
            'footer.required' => 'Footer harus diisi.',
            'footer.max' => 'Footer maksimal 255 karakter.',
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
