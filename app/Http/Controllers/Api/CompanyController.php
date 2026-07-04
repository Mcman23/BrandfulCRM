<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(
            Company::withCount(['clients', 'users', 'services'])->orderBy('created_at', 'desc')->get()
        );
    }

    public function show($id)
    {
        $company = Company::with(['clients' => fn($q) => $q->orderBy('created_at', 'desc')->take(10), 'services', 'users' => fn($q) => $q->select('id', 'name', 'email', 'role')])->findOrFail($id);
        return response()->json($company);
    }

    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return response()->json($company, 201);
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());
        return response()->json($company);
    }

    public function toggleStatus($id)
    {
        $company = Company::findOrFail($id);
        $company->status = $company->status === \App\Enums\CompanyStatus::ACTIVE ? \App\Enums\CompanyStatus::INACTIVE : \App\Enums\CompanyStatus::ACTIVE;
        $company->save();
        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(['message' => 'Şirkət silindi']);
    }
}

