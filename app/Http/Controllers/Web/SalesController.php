<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Payment;
use App\Enums\DealStatus;
use App\Enums\PaymentStatus;

class SalesController extends Controller
{
    public function index()
    {
        $companyId = session('selected_company_id');
        $dealsQuery = Deal::with(['client:id,client_name', 'client.company:id,company_name', 'service']);
        $paymentsQuery = Payment::with(['client:id,client_name', 'client.company:id,company_name']);

        if ($companyId) {
            $dealsQuery->whereHas('client', fn($q) => $q->where('company_id', $companyId));
            $paymentsQuery->whereHas('client', fn($q) => $q->where('company_id', $companyId));
        }

        $deals = $dealsQuery->orderBy('created_at', 'desc')->take(10)->get();
        $payments = $paymentsQuery->orderBy('created_at', 'desc')->take(10)->get();

        $allDeals = $companyId ? Deal::whereHas('client', fn($q) => $q->where('company_id', $companyId))->get() : Deal::all();
        $allPayments = $companyId ? Payment::whereHas('client', fn($q) => $q->where('company_id', $companyId))->get() : Payment::all();

        $totalAmount = $allDeals->sum('amount');
        $wonDeals = $allDeals->filter(fn($d) => $d->status === DealStatus::QAZANILDI);
        $wonAmount = $wonDeals->sum('amount');
        $conversionRate = $allDeals->count() > 0 ? ($wonDeals->count() / $allDeals->count()) * 100 : 0;
        $paidAmount = $allPayments->filter(fn($p) => $p->status === PaymentStatus::ODENILDI)->sum('amount');

        return view('sales', compact('deals', 'payments', 'totalAmount', 'wonAmount', 'wonDeals', 'conversionRate', 'paidAmount'));
    }
}

