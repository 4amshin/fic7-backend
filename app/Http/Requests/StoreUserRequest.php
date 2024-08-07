<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                function ($value, $fail) {
                    //cek email yang terdaftar
                    $existingEmail = User::where('email', $value)->exists();
                    if ($existingEmail) {
                        $fail('Email Pengguna telah terdaftar.');
                    }
                }
            ],
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
            'unhashed_password' => 'required|string',
            'password' => 'nullable|string',
        ];
    }
}
