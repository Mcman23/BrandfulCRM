<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'company_id' => 'required|uuid|exists:companies,id',
            'client_name' => 'required|string|max:255',
            'client_company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'industry' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'company_id.required' => 'Şirkət seçin',
            'client_name.required' => 'Müştəri adı tələb olunur',
            'email.email' => 'Düzgün email daxil edin',
        ];
    }
}

