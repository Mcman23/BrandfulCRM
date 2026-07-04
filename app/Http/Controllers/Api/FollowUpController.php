<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUpRequest;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function index(Request $request)
    {
        $query = FollowUp::with(['client:id,client_name', 'client.company:id,company_name', 'user:id,name']);
        if ($request->has('client_id')) $query->where('client_id', $request->client_id);
        if ($request->has('status')) $query->where('status', $request->status);
        if ($request->has('user_id')) $query->where('user_id', $request->user_id);
        return response()->json($query->orderBy('reminder_date', 'asc')->get());
    }

    public function show($id)
    {
        return response()->json(FollowUp::with(['client', 'user'])->findOrFail($id));
    }

    public function store(FollowUpRequest $request)
    {
        $data = $request->validated();
        $data['reminder_date'] = \Carbon\Carbon::parse($data['reminder_date']);
        $followUp = FollowUp::create($data);
        $followUp->load('client');
        return response()->json($followUp, 201);
    }

    public function update(FollowUpRequest $request, $id)
    {
        $followUp = FollowUp::findOrFail($id);
        $data = $request->validated();
        if (!empty($data['reminder_date'])) $data['reminder_date'] = \Carbon\Carbon::parse($data['reminder_date']);
        $followUp->update($data);
        return response()->json($followUp);
    }

    public function destroy($id)
    {
        $followUp = FollowUp::findOrFail($id);
        $followUp->delete();
        return response()->json(['message' => 'Geri dönüş silindi']);
    }
}

