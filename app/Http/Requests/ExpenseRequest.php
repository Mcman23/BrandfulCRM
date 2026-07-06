<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'company_id' => 'required|uuid|exists:companies,id',
            'deal_id' => 'nullable|uuid|exists:deals,id',
            'title' => 'required|string|max:255',
            'category' => 'required|in:NEQLIYYAT,MATERIAL,EMEK_HAQQI,MARKETINQ,ICARE,DIGER',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Şirkət tələb olunur',
            'title.required' => 'Xərcin adı tələb olunur',
            'category.required' => 'Kateqoriya tələb olunur',
            'amount.required' => 'Məbləğ tələb olunur',
            'amount.numeric' => 'Məbləğ rəqəm olmalıdır',
            'expense_date.required' => 'Tarix tələb olunur',
        ];
    }
}
