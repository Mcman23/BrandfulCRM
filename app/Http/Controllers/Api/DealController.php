<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealRequest;
use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
    {
        $query = Deal::with(['client:id,client_name', 'client.company:id,company_name', 'service']);
        if ($request->has('client_id')) $query->where('client_id', $request->client_id);
        if ($request->has('status')) $query->where('status', $request->status);
        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function stats(Request $request)
    {
        $query = Deal::with(['client:id,company_id']);
        if ($request->has('company_id')) {
            $query->whereHas('client', fn($q) => $q->where('company_id', $request->company_id));
        }
        $deals = $query->get();
        $total = $deals->sum('amount');
        $won = $deals->filter(fn($d) => $d->status === \App\Enums\DealStatus::QAZANILDI);
        $wonTotal = $won->sum('amount');
        return response()->json([
            'totalDeals' => $deals->count(),
            'totalAmount' => $total,
            'wonDeals' => $won->count(),
            'wonAmount' => $wonTotal,
            'conversionRate' => $deals->count() > 0 ? ($won->count() / $deals->count()) * 100 : 0,
        ]);
    }

    public function show($id)
    {
        return response()->json(Deal::with(['client', 'service'])->findOrFail($id));
    }

    public function store(DealRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['close_date'])) $data['close_date'] = \Carbon\Carbon::parse($data['close_date']);
        $deal = Deal::create($data);
        $deal->load(['client', 'service']);
        return response()->json($deal, 201);
    }

    public function update(DealRequest $request, $id)
    {
        $deal = Deal::findOrFail($id);
        $data = $request->validated();
        if (!empty($data['close_date'])) $data['close_date'] = \Carbon\Carbon::parse($data['close_date']);
        $deal->update($data);
        return response()->json($deal);
    }

    public function destroy($id)
    {
        $deal = Deal::findOrFail($id);
        $deal->delete();
        return response()->json(['message' => 'Satış silindi']);
    }
}

