<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',

                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'phone'=> [
                'nullable',
                'string',
                'max:20',
                'regex:/^(\+62|62|0)8[1-9][0-9]{6,10}$/',

            ],

            // Address: opsional, text max 500 karakter
            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            // Avatar: opsional
            // Harus file gambar (mime: jpg, png, webp)
            // Max ukuran 2MB (2048 KB)
            // Dimensi minimal 100x100px agar tidak pecah/blur
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048'
        ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'phone.regex' => 'Format nomor telepon tidak valid. Gunakan format 08xx atau +628xx.',
            'avatar.max' => 'Ukuran foto maksimal 2MB.',
            'avatar.dimensions' => 'Dimensi foto harus antara 100x100 hingga 2000x2000 pixel.',
            'email.required' => 'Alamat email harus diisi.',
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name ' => 'nama',
            'email' => 'alamat email',
            'phone' => 'nomor telepon',
            'address' => 'alamat',
            'avatar' => 'foto profile',
        ];
    }
}