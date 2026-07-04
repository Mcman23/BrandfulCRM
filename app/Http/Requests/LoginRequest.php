<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'remember' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Email tələb olunur',
            'email.email' => 'Düzgün email daxil edin',
            'password.required' => 'Şifrə tələb olunur',
            'password.min' => 'Şifrə ən azı 6 simvol olmalıdır',
        ];
    }
}

