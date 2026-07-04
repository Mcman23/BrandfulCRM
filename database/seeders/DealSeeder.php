<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deal;
use App\Models\Client;
use App\Models\Service;
use App\Enums\DealStatus;
use Carbon\Carbon;

class DealSeeder extends Seeder
{
    public function run(): void
    {
        $c3 = Client::where('client_name', 'Vüqar İsmayılov')->first();
        $c6 = Client::where('client_name', 'Kamran Vəliyev')->first();
        $webDev = Service::where('name', 'Sayt hazırlanması')->first();
        $kimyevi = Service::where('name', 'Kimyəvi təmizləmə')->first();

        Deal::create(['client_id' => $c3->id, 'service_id' => $webDev->id, 'amount' => 3500, 'status' => DealStatus::ACIQ, 'close_date' => Carbon::now()->addDays(7)]);
        Deal::create(['client_id' => $c6->id, 'service_id' => $kimyevi->id, 'amount' => 400, 'status' => DealStatus::QAZANILDI, 'close_date' => Carbon::now()]);
    }
}

