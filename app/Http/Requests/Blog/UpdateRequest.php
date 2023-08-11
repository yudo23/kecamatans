<?php

namespace App\Http\Requests\Blog;

use App\Enums\BlogEnum;
use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                Rule::exists('blog_categories', 'id'),
            ],
            'title' => [
                'required'
            ],
            'fragment' => [
                'required'
            ],
            'image' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg',
            ],
            'status' => [
                'required',
                'in:'.implode(",",[BlogEnum::STATUS_TRUE,BlogEnum::STATUS_FALSE])
            ],
            'blog-trixFields.content' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori harus diisi',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'title.required' => 'Judul berita harus diisi',
            'fragment.required' => 'Penggalan konten harus diisi',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg, png , jpg',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status tidak valid',
            'blog-trixFields.content.required' => 'Konten harus diisi',
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