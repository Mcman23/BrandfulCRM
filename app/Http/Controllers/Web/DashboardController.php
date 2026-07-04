<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Deal;
use App\Models\Payment;
use App\Models\FollowUp;
use App\Enums\LeadStatus;
use App\Enums\FollowUpStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $companyId = session('selected_company_id');
        $clientsQuery = Client::query();
        $leadsQuery = Lead::query();
        $dealsQuery = Deal::query()->whereHas('client', fn($q) => $q->when($companyId, fn($sq) => $sq->where('company_id', $companyId)));
        $paymentsQuery = Payment::query()->whereHas('client', fn($q) => $q->when($companyId, fn($sq) => $sq->where('company_id', $companyId)));

        if ($companyId) {
            $clientsQuery->where('company_id', $companyId);
            $leadsQuery->where('company_id', $companyId);
        }

        $totalClients = $clientsQuery->count();
        $newLeads = (clone $leadsQuery)->where('status', LeadStatus::YENI_MURACIET)->orderBy('created_at', 'desc')->take(5)->get();
        $activeDeals = (clone $leadsQuery)->whereIn('status', [LeadStatus::DANISIQ_GEDIR, LeadStatus::TEKLIF_GONDERILDI])->count();
        $deals = $dealsQuery->get();
        $wonAmount = $deals->filter(fn($d) => $d->status === \App\Enums\DealStatus::QAZANILDI)->sum('amount');
        $payments = $paymentsQuery->get();
        $paidAmount = $payments->filter(fn($p) => $p->status === \App\Enums\PaymentStatus::ODENILDI)->sum('amount');
        $paidCount = $payments->filter(fn($p) => $p->status === \App\Enums\PaymentStatus::ODENILDI)->count();
        $pendingFollowUps = FollowUp::where('status', FollowUpStatus::GOZLEYEN)->orderBy('reminder_date', 'asc')->take(5)->get();

        return view('dashboard', compact('totalClients', 'newLeads', 'activeDeals', 'wonAmount', 'paidAmount', 'paidCount', 'pendingFollowUps', 'payments'));
    }
}

