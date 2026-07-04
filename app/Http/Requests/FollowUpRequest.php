<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'client_id' => 'required|uuid|exists:clients,id',
            'user_id' => 'nullable|uuid|exists:users,id',
            'title' => 'required|string|max:255',
            'reminder_date' => 'required|date',
            'status' => 'nullable|in:GOZLEYEN,TAMAMLANMIS,KECMIS',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Başlıq tələb olunur',
            'reminder_date.required' => 'Tarix tələb olunur',
            'reminder_date.date' => 'Düzgün tarix daxil edin',
        ];
    }
}

