<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'client_id' => 'required|uuid|exists:clients,id',
            'user_id' => 'required|uuid|exists:users,id',
            'type' => 'required|in:ZENG,WHATSAPP,GORUS,EMAIL',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ];
    }
    public function messages(): array
    {
        return [
            'type.required' => 'Əlaqə növü seçin',
            'client_id.required' => 'Müştəri seçin',
        ];
    }
}

