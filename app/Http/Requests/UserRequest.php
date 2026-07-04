<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? $this->route('id');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($userId ?? 'NULL') . ',id',
            'password' => $this->isMethod('POST') ? 'required|string|min:6' : 'nullable|string|min:6',
            'role' => 'nullable|in:SUPER_ADMIN,ADMIN,MENEGER,SATIS_EMKDAS',
            'company_id' => 'nullable|uuid|exists:companies,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Ad tələb olunur',
            'email.required' => 'Email tələb olunur',
            'email.unique' => 'Bu email artıq qeydiyyatlıdır',
            'password.required' => 'Şifrə tələb olunur',
            'password.min' => 'Şifrə ən azı 6 simvol olmalıdır',
        ];
    }
}

