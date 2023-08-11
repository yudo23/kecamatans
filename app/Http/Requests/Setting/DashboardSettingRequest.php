<?php

namespace App\Http\Requests\Setting;

use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DashboardSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'max:255',
            ],
            'logo_light_lg' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'logo_light_sm' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg,svg',
            ],
            'logo_auth' => [
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
            'title.max' => 'Judul maksimal 255 karakter.',
            'logo_light.image' => 'Logo harus berupa gambar',
            'logo_light_lg.mimes' => 'Logo light (large) harus berupa jpeg,png,jpg,svg',
            'logo_light_lg.max' => 'Logo light (large) tidak boleh lebih dari 2MB',
            'logo_light_sm.mimes' => 'Logo light (small) harus berupa jpeg,png,jpg,svg',
            'logo_light_sm.max' => 'Logo light (small) tidak boleh lebih dari 2MB',
            'logo_auth.image' => 'Logo auth harus berupa gambar',
            'logo_auth.mimes' => 'Logo auth harus berupa jpeg,png,jpg,svg',
            'logo_auth.max' => 'Logo auth tidak boleh lebih dari 2MB',
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
