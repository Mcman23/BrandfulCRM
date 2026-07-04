<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Client;
use App\Models\User;
use App\Enums\ActivityType;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $c1 = Client::where('client_name', 'Elnur Quliyev')->first();
        $c2 = Client::where('client_name', 'Nigar Əhmədova')->first();
        $c3 = Client::where('client_name', 'Vüqar İsmayılov')->first();
        $c4 = Client::where('client_name', 'Zaur Tağıyev')->first();
        $c6 = Client::where('client_name', 'Kamran Vəliyev')->first();
        $brandfulSatis = User::where('email', 'reshad@brandful.az')->first();
        $brandfulMenecer = User::where('email', 'aysel@brandful.az')->first();
        $brillianceMenecer = User::where('email', 'leyla@brilliance.az')->first();

        Activity::create(['client_id' => $c1->id, 'user_id' => $brandfulSatis->id, 'type' => ActivityType::WHATSAPP, 'description' => 'SMM xidməti haqqında məlumat göndərildi', 'date' => Carbon::now()->subDay()]);
        Activity::create(['client_id' => $c2->id, 'user_id' => $brandfulSatis->id, 'type' => ActivityType::ZENG, 'description' => 'Google Ads üçün ilkin söhbət', 'date' => Carbon::now()->subDays(2)]);
        Activity::create(['client_id' => $c3->id, 'user_id' => $brandfulMenecer->id, 'type' => ActivityType::GORUS, 'description' => 'Sayt dizaynı üçün görüş keçirildi', 'date' => Carbon::now()->subDays(3)]);
        Activity::create(['client_id' => $c3->id, 'user_id' => $brandfulMenecer->id, 'type' => ActivityType::EMAIL, 'description' => 'Təklif göndərildi', 'date' => Carbon::now()->subDay()]);
        Activity::create(['client_id' => $c4->id, 'user_id' => $brillianceMenecer->id, 'type' => ActivityType::ZENG, 'description' => 'Ofis təmizliyi üçün qiymət sorğusu', 'date' => Carbon::now()->subDay()]);
        Activity::create(['client_id' => $c6->id, 'user_id' => $brillianceMenecer->id, 'type' => ActivityType::WHATSAPP, 'description' => 'Kimyəvi təmizləmə sifarişi alındı', 'date' => Carbon::now()]);
    }
}

