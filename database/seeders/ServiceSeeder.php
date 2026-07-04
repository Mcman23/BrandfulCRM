<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Company;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $brandful = Company::where('company_name', 'Brandful Agency')->first();
        $brilliance = Company::where('company_name', 'Brilliance Cleaning')->first();

        $smm = Service::create(['company_id' => $brandful->id, 'name' => 'SMM', 'description' => 'Sosial media menecment', 'price' => 800]);
        $googleAds = Service::create(['company_id' => $brandful->id, 'name' => 'Google Ads', 'description' => 'Reklam kampaniyaları', 'price' => 1200]);
        $webDev = Service::create(['company_id' => $brandful->id, 'name' => 'Sayt hazırlanması', 'description' => 'Veb sayt dizayn və proqramlaşdırma', 'price' => 3500]);

        $ofisTemizliyi = Service::create(['company_id' => $brilliance->id, 'name' => 'Ofis təmizliyi', 'description' => 'Günlük ofis təmizlənməsi', 'price' => 250]);
        $postTemir = Service::create(['company_id' => $brilliance->id, 'name' => 'Post təmir təmizliyi', 'description' => 'Təmirdən sonra ümumi təmizlik', 'price' => 600]);
        $kimyevi = Service::create(['company_id' => $brilliance->id, 'name' => 'Kimyəvi təmizləmə', 'description' => 'Xüsusi kimyəvi təmizləmə xidməti', 'price' => 400]);
    }
}

