<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::with(['company:id,company_name'])->withCount(['leads', 'deals', 'payments']);
        $companyId = session('selected_company_id');
        if ($companyId) $query->where('company_id', $companyId);
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('client_company_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($request->filled('industry')) $query->where('industry', 'like', '%' . $request->industry . '%');
        $clients = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        $companies = Company::orderBy('company_name')->get();
        return view('clients.index', compact('clients', 'companies'));
    }

    public function show($id)
    {
        $client = Client::with([
            'company', 'leads.service', 'leads.assignedTo:id,name', 'deals.service', 'deals.expenses', 'payments',
            'followUps' => fn($q) => $q->orderBy('reminder_date', 'asc'),
            'activities.user:id,name' => fn($q) => $q->orderBy('date', 'desc'),
        ])->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Müştəri əlavə edildi');
    }

    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Müştəri yeniləndi');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Müştəri silindi');
    }
}

