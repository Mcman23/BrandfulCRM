<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Client;
use App\Enums\PaymentStatus;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $c3 = Client::where('client_name', 'Vüqar İsmayılov')->first();
        $c6 = Client::where('client_name', 'Kamran Vəliyev')->first();

        Payment::create(['client_id' => $c6->id, 'amount' => 400, 'status' => PaymentStatus::ODENILDI, 'payment_date' => Carbon::now()]);
        Payment::create(['client_id' => $c3->id, 'amount' => 1750, 'status' => PaymentStatus::GOZLEMEDE, 'payment_date' => Carbon::now()->addDays(3)]);
    }
}

