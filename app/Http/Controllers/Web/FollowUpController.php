<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FollowUp;
use App\Enums\FollowUpStatus;

class FollowUpController extends Controller
{
    public function index()
    {
        $followUps = FollowUp::with(['client:id,client_name', 'client.company:id,company_name', 'user:id,name'])
            ->orderBy('reminder_date', 'asc')->get();
        $overdue = $followUps->filter(fn($f) => $f->status === FollowUpStatus::GOZLEYEN && $f->reminder_date < now());
        $upcoming = $followUps->filter(fn($f) => $f->status === FollowUpStatus::GOZLEYEN && $f->reminder_date >= now());
        return view('follow-ups', compact('overdue', 'upcoming'));
    }
}

