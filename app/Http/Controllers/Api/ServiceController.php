<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with(['company:id,company_name'])->withCount(['leads', 'deals']);
        if ($request->has('company_id')) $query->where('company_id', $request->company_id);
        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function show($id)
    {
        return response()->json(Service::findOrFail($id));
    }

    public function store(ServiceRequest $request)
    {
        return response()->json(Service::create($request->validated()), 201);
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Xidmət silindi']);
    }
}

