<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FollowUp;
use App\Models\Client;
use App\Models\User;
use App\Enums\FollowUpStatus;
use Carbon\Carbon;

class FollowUpSeeder extends Seeder
{
    public function run(): void
    {
        $c1 = Client::where('client_name', 'Elnur Quliyev')->first();
        $c2 = Client::where('client_name', 'Nigar Əhmədova')->first();
        $c5 = Client::where('client_name', 'Aynur Səfərova')->first();
        $brandfulSatis = User::where('email', 'reshad@brandful.az')->first();
        $brillianceMenecer = User::where('email', 'leyla@brilliance.az')->first();

        FollowUp::create(['client_id' => $c1->id, 'user_id' => $brandfulSatis->id, 'title' => 'SMM təklifini göndər', 'reminder_date' => Carbon::now()->addDay(), 'status' => FollowUpStatus::GOZLEYEN]);
        FollowUp::create(['client_id' => $c2->id, 'user_id' => $brandfulSatis->id, 'title' => 'Google Ads kampaniyası müzakirəsi', 'reminder_date' => Carbon::now()->addDays(2), 'status' => FollowUpStatus::GOZLEYEN]);
        FollowUp::create(['client_id' => $c5->id, 'user_id' => $brillianceMenecer->id, 'title' => 'Görüş təsdiqi', 'reminder_date' => Carbon::now()->subDay(), 'status' => FollowUpStatus::KECMIS]);
    }
}

