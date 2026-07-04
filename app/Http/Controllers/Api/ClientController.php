<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::with(['company:id,company_name'])->withCount(['leads', 'deals', 'payments']);
        if ($request->has('company_id')) $query->where('company_id', $request->company_id);
        if ($request->has('industry') && $request->industry) $query->where('industry', 'like', '%' . $request->industry . '%');
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('client_company_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function show($id)
    {
        $client = Client::with([
            'company', 'leads.service', 'leads.assignedTo:id,name', 'deals.service', 'payments',
            'followUps' => fn($q) => $q->orderBy('reminder_date', 'asc'),
            'activities.user:id,name' => fn($q) => $q->orderBy('date', 'desc'),
        ])->findOrFail($id);
        return response()->json($client);
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());
        return response()->json($client, 201);
    }

    public function update(ClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->validated());
        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(['message' => 'Müştəri silindi']);
    }
}

