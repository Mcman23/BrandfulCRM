<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Company;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $brandful = Company::where('company_name', 'Brandful Agency')->first();
        $brilliance = Company::where('company_name', 'Brilliance Cleaning')->first();

        $c1 = Client::create(['company_id' => $brandful->id, 'client_name' => 'Elnur Quliyev', 'client_company_name' => 'TechHub MMC', 'phone' => '+994 70 555 12 34', 'whatsapp' => '+994 70 555 12 34', 'email' => 'elnur@techhub.az', 'address' => 'Bakı, Xətai rayonu', 'industry' => 'İT', 'notes' => 'SMM və sayt üçün maraqlı']);
        $c2 = Client::create(['company_id' => $brandful->id, 'client_name' => 'Nigar Əhmədova', 'client_company_name' => 'Beauty Studio', 'phone' => '+994 77 333 45 67', 'whatsapp' => '+994 77 333 45 67', 'email' => 'nigar@beauty.az', 'address' => 'Bakı, Səbail rayonu', 'industry' => 'Gözəllik', 'notes' => 'Google Ads üçün maraqlı']);
        $c3 = Client::create(['company_id' => $brandful->id, 'client_name' => 'Vüqar İsmayılov', 'client_company_name' => 'AutoParts', 'phone' => '+994 50 777 89 01', 'email' => 'vugar@autoparts.az', 'address' => 'Bakı, Nəsimi rayonu', 'industry' => 'Avtomobil', 'notes' => 'Sayt yenilənməsi lazımdır']);

        $c4 = Client::create(['company_id' => $brilliance->id, 'client_name' => 'Zaur Tağıyev', 'client_company_name' => 'Plaza Mall', 'phone' => '+994 55 111 22 33', 'whatsapp' => '+994 55 111 22 33', 'email' => 'zaur@plaza.az', 'address' => 'Bakı, Nərimanov rayonu', 'industry' => 'Ticarət', 'notes' => 'Həftəlik ofis təmizliyi']);
        $c5 = Client::create(['company_id' => $brilliance->id, 'client_name' => 'Aynur Səfərova', 'client_company_name' => 'Medical Center', 'phone' => '+994 70 444 55 66', 'whatsapp' => '+994 70 444 55 66', 'email' => 'aynur@medical.az', 'address' => 'Bakı, Yasamal rayonu', 'industry' => 'Səhiyyə', 'notes' => 'Post təmir təmizliyi lazımdır']);
        $c6 = Client::create(['company_id' => $brilliance->id, 'client_name' => 'Kamran Vəliyev', 'client_company_name' => 'Logistics Co', 'phone' => '+994 77 222 33 44', 'email' => 'kamran@logistics.az', 'address' => 'Bakı, Binəqədi rayonu', 'industry' => 'Logistika', 'notes' => 'Kimyəvi təmizləmə lazımdır']);
    }
}

