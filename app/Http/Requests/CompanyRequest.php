<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'status' => 'nullable|in:ACTIVE,INACTIVE',
        ];
    }
    public function messages(): array
    {
        return [
            'company_name.required' => 'Şirkət adı tələb olunur',
            'email.email' => 'Düzgün email daxil edin',
        ];
    }
}

