<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::with(['client', 'company:id,company_name', 'service', 'assignedTo:id,name']);
        if ($request->has('company_id')) $query->where('company_id', $request->company_id);
        if ($request->has('status')) $query->where('status', $request->status);
        if ($request->has('assigned_user')) $query->where('assigned_user', $request->assigned_user);
        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function show($id)
    {
        return response()->json(Lead::with(['client', 'company', 'service', 'assignedTo'])->findOrFail($id));
    }

    public function store(LeadRequest $request)
    {
        $lead = Lead::create($request->validated());
        $lead->load(['client', 'service']);
        return response()->json($lead, 201);
    }

    public function update(LeadRequest $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->validated());
        return response()->json($lead);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:YENI_MURACIET,ELAQE_SAXLANILDI,GORUS_TEYIN_EDILDI,TEKLIF_GONDERILDI,DANISIQ_GEDIR,QAZANILDI,ITIRILDI']);
        $lead = Lead::findOrFail($id);
        $lead->status = $request->status;
        $lead->save();
        return response()->json($lead);
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return response()->json(['message' => 'Lead silindi']);
    }
}

