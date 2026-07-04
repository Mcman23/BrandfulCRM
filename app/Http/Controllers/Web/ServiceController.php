<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\Company;

class ServiceController extends Controller
{
    public function index()
    {
        $companyId = session('selected_company_id');
        $query = Service::with(['company:id,company_name'])->withCount(['leads', 'deals']);
        if ($companyId) $query->where('company_id', $companyId);
        $services = $query->orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('company_name')->get();
        return view('services', compact('services', 'companies'));
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());
        return redirect()->route('services')->with('success', 'Xidmət yaradıldı');
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return redirect()->route('services')->with('success', 'Xidmət yeniləndi');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services')->with('success', 'Xidmət silindi');
    }
}

