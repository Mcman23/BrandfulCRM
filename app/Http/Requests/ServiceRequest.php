<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'company_id' => 'required|uuid|exists:companies,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Xidmət adı tələb olunur',
            'price.required' => 'Qiymət tələb olunur',
            'price.numeric' => 'Qiymət rəqəm olmalıdır',
        ];
    }
}

