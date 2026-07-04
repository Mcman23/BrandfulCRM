<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Enums\LeadStatus;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $brandful = \App\Models\Company::where('company_name', 'Brandful Agency')->first();
        $brilliance = \App\Models\Company::where('company_name', 'Brilliance Cleaning')->first();
        $smm = Service::where('name', 'SMM')->first();
        $googleAds = Service::where('name', 'Google Ads')->first();
        $webDev = Service::where('name', 'Sayt hazırlanması')->first();
        $ofisTemizliyi = Service::where('name', 'Ofis təmizliyi')->first();
        $postTemir = Service::where('name', 'Post təmir təmizliyi')->first();
        $kimyevi = Service::where('name', 'Kimyəvi təmizləmə')->first();
        $brandfulSatis = User::where('email', 'reshad@brandful.az')->first();
        $brandfulMenecer = User::where('email', 'aysel@brandful.az')->first();
        $brillianceMenecer = User::where('email', 'leyla@brilliance.az')->first();

        $c1 = Client::where('client_name', 'Elnur Quliyev')->first();
        $c2 = Client::where('client_name', 'Nigar Əhmədova')->first();
        $c3 = Client::where('client_name', 'Vüqar İsmayılov')->first();
        $c4 = Client::where('client_name', 'Zaur Tağıyev')->first();
        $c5 = Client::where('client_name', 'Aynur Səfərova')->first();
        $c6 = Client::where('client_name', 'Kamran Vəliyev')->first();

        Lead::create(['company_id' => $brandful->id, 'client_id' => $c1->id, 'source' => 'Instagram', 'status' => LeadStatus::YENI_MURACIET, 'service_id' => $smm->id, 'budget' => 800, 'assigned_user' => $brandfulSatis->id]);
        Lead::create(['company_id' => $brandful->id, 'client_id' => $c2->id, 'source' => 'Google Axtarış', 'status' => LeadStatus::ELAQE_SAXLANILDI, 'service_id' => $googleAds->id, 'budget' => 1200, 'assigned_user' => $brandfulSatis->id]);
        Lead::create(['company_id' => $brandful->id, 'client_id' => $c3->id, 'source' => 'Tövsiyə', 'status' => LeadStatus::TEKLIF_GONDERILDI, 'service_id' => $webDev->id, 'budget' => 3500, 'assigned_user' => $brandfulMenecer->id]);
        Lead::create(['company_id' => $brilliance->id, 'client_id' => $c4->id, 'source' => 'Veb sayt', 'status' => LeadStatus::DANISIQ_GEDIR, 'service_id' => $ofisTemizliyi->id, 'budget' => 1000, 'assigned_user' => $brillianceMenecer->id]);
        Lead::create(['company_id' => $brilliance->id, 'client_id' => $c5->id, 'source' => 'Facebook', 'status' => LeadStatus::GORUS_TEYIN_EDILDI, 'service_id' => $postTemir->id, 'budget' => 600]);
        Lead::create(['company_id' => $brilliance->id, 'client_id' => $c6->id, 'source' => 'Telefon zəngi', 'status' => LeadStatus::QAZANILDI, 'service_id' => $kimyevi->id, 'budget' => 400]);
    }
}

