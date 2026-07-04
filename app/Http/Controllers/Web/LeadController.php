<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Service;
use App\Models\Company;
use App\Enums\LeadStatus;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $companyId = session('selected_company_id');
        $query = Lead::with(['client', 'company:id,company_name', 'service', 'assignedTo:id,name']);
        if ($companyId) $query->where('company_id', $companyId);
        $leads = $query->orderBy('created_at', 'desc')->get();
        $companies = Company::orderBy('company_name')->get();
        $clients = Client::when($companyId, fn($q) => $q->where('company_id', $companyId))->orderBy('client_name')->get();
        $services = Service::when($companyId, fn($q) => $q->where('company_id', $companyId))->orderBy('name')->get();
        $columns = LeadStatus::columns();
        return view('pipeline', compact('leads', 'companies', 'clients', 'services', 'columns'));
    }

    public function store(LeadRequest $request)
    {
        Lead::create($request->validated());
        return redirect()->route('pipeline')->with('success', 'Lead yaradıldı');
    }

    public function updateStatus(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->status = LeadStatus::from($request->status);
        $lead->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return redirect()->route('pipeline')->with('success', 'Lead silindi');
    }
}

