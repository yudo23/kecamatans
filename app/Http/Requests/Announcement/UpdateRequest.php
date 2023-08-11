<?php

namespace App\Http\Requests\Announcement;

use App\Enums\AnnouncementEnum;
use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
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
            'date' => [
                'required',
                'date',
            ],
            'status' => [
                'required',
                'in:'.implode(",",[AnnouncementEnum::STATUS_TRUE,AnnouncementEnum::STATUS_FALSE])
            ],
            'announcement-trixFields.content' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pengumuman harus diisi',
            'fragment.required' => 'Penggalan konten harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpeg, png , jpg',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB',
            'date.required' => 'Tanggal pengumuman tidak boleh kosong',
            'date.date' => 'Tanggal pengumuman tidak valid',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status tidak valid',
            'announcement-trixFields.content.required' => 'Konten harus diisi',
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