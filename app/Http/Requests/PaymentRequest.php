<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'client_id' => 'required|uuid|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|in:ODENILDI,GOZLEMEDE,ODENILMEMIS',
            'payment_date' => 'nullable|date',
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

