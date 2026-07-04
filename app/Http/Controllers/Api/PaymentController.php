<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['client:id,client_name', 'client.company:id,company_name']);
        if ($request->has('client_id')) $query->where('client_id', $request->client_id);
        if ($request->has('status')) $query->where('status', $request->status);
        return response()->json($query->orderBy('created_at', 'desc')->get());
    }

    public function stats(Request $request)
    {
        $query = Payment::with(['client:id,company_id']);
        if ($request->has('company_id')) {
            $query->whereHas('client', fn($q) => $q->where('company_id', $request->company_id));
        }
        $payments = $query->get();
        $total = $payments->sum('amount');
        $paid = $payments->filter(fn($p) => $p->status === \App\Enums\PaymentStatus::ODENILDI);
        $paidTotal = $paid->sum('amount');
        return response()->json([
            'totalPayments' => $payments->count(),
            'totalAmount' => $total,
            'paidCount' => $paid->count(),
            'paidAmount' => $paidTotal,
        ]);
    }

    public function show($id)
    {
        return response()->json(Payment::with(['client'])->findOrFail($id));
    }

    public function store(PaymentRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['payment_date'])) $data['payment_date'] = \Carbon\Carbon::parse($data['payment_date']);
        $payment = Payment::create($data);
        return response()->json($payment, 201);
    }

    public function update(PaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $data = $request->validated();
        if (!empty($data['payment_date'])) $data['payment_date'] = \Carbon\Carbon::parse($data['payment_date']);
        $payment->update($data);
        return response()->json($payment);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Ödəniş silindi']);
    }
}

