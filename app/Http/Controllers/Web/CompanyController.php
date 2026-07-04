<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Enums\CompanyStatus;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount(['clients', 'users', 'services'])->orderBy('created_at', 'desc')->get();
        return view('companies', compact('companies'));
    }

    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());
        return redirect()->route('companies')->with('success', 'Şirkət yaradıldı');
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());
        return redirect()->route('companies')->with('success', 'Şirkət yeniləndi');
    }

    public function toggleStatus($id)
    {
        $company = Company::findOrFail($id);
        $company->status = $company->status === CompanyStatus::ACTIVE ? CompanyStatus::INACTIVE : CompanyStatus::ACTIVE;
        $company->save();
        return redirect()->route('companies')->with('success', 'Status dəyişildi');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('companies')->with('success', 'Şirkət silindi');
    }
}

