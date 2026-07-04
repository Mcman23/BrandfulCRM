<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'company_id' => 'required|uuid|exists:companies,id',
            'client_id' => 'required|uuid|exists:clients,id',
            'source' => 'required|string|max:255',
            'status' => 'nullable|in:YENI_MURACIET,ELAQE_SAXLANILDI,GORUS_TEYIN_EDILDI,TEKLIF_GONDERILDI,DANISIQ_GEDIR,QAZANILDI,ITIRILDI',
            'service_id' => 'nullable|uuid|exists:services,id',
            'budget' => 'nullable|numeric|min:0',
            'assigned_user' => 'nullable|uuid|exists:users,id',
        ];
    }
    public function messages(): array
    {
        return [
            'source.required' => 'Mənbə tələb olunur',
            'client_id.required' => 'Müştəri seçin',
            'company_id.required' => 'Şirkət seçin',
        ];
    }
}

