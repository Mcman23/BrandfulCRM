<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'client_id' => 'required|uuid|exists:clients,id',
            'service_id' => 'nullable|uuid|exists:services,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:ACIQ,QAZANILDI,ITIRILDI',
            'close_date' => 'nullable|date',
        ];
    }
    public function messages(): array
    {
        return [
            'amount.required' => 'Məbləğ tələb olunur',
            'amount.numeric' => 'Məbləğ rəqəm olmalıdır',
            'client_id.required' => 'Müştəri seçin',
        ];
    }
}

