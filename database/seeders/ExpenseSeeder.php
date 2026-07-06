<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Deal;
use App\Models\Company;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $brandful = Company::where('company_name', 'Brandful Agency')->first();
        $brilliance = Company::where('company_name', 'Brilliance Cleaning')->first();
        $webDeal = Deal::where('amount', 3500)->first();
        $cleaningDeal = Deal::where('amount', 400)->first();

        if ($brandful && $webDeal) {
            Expense::create(['company_id' => $brandful->id, 'deal_id' => $webDeal->id, 'title' => 'Freelancer dizayner', 'category' => 'EMEK_HAQQI', 'amount' => 600, 'expense_date' => Carbon::now()->subDays(3), 'notes' => 'UI/UX dizayn işləri']);
            Expense::create(['company_id' => $brandful->id, 'deal_id' => $webDeal->id, 'title' => 'Hosting və domen', 'category' => 'DIGER', 'amount' => 120, 'expense_date' => Carbon::now()->subDays(2)]);
        }
        if ($brilliance && $cleaningDeal) {
            Expense::create(['company_id' => $brilliance->id, 'deal_id' => $cleaningDeal->id, 'title' => 'Təmizlik kimyəvi maddələri', 'category' => 'MATERIAL', 'amount' => 45, 'expense_date' => Carbon::now()->subDay()]);
            Expense::create(['company_id' => $brilliance->id, 'deal_id' => $cleaningDeal->id, 'title' => 'Nəqliyyat xərci', 'category' => 'NEQLIYYAT', 'amount' => 25, 'expense_date' => Carbon::now()]);
        }
        if ($brandful) {
            Expense::create(['company_id' => $brandful->id, 'deal_id' => null, 'title' => 'Ofis icarəsi', 'category' => 'ICARE', 'amount' => 800, 'expense_date' => Carbon::now()->subDays(10)]);
        }
    }
}
