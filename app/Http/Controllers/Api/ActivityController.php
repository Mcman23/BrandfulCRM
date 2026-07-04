<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with(['client:id,client_name', 'client.company:id,company_name', 'user:id,name']);
        if ($request->has('client_id')) $query->where('client_id', $request->client_id);
        if ($request->has('user_id')) $query->where('user_id', $request->user_id);
        if ($request->has('type')) $query->where('type', $request->type);
        return response()->json($query->orderBy('date', 'desc')->get());
    }

    public function show($id)
    {
        return response()->json(Activity::with(['client', 'user'])->findOrFail($id));
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['date'])) $data['date'] = \Carbon\Carbon::parse($data['date']);
        $activity = Activity::create($data);
        $activity->load(['client', 'user']);
        return response()->json($activity, 201);
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $validated = $request->validate([
            'type' => 'nullable|in:ZENG,WHATSAPP,GORUS,EMAIL',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
        if (!empty($validated['date'])) $validated['date'] = \Carbon\Carbon::parse($validated['date']);
        $activity->update($validated);
        return response()->json($activity);
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return response()->json(['message' => 'Əlaqə silindi']);
    }
}

