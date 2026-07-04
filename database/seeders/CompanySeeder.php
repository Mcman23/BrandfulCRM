<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Enums\CompanyStatus;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'company_name' => 'Brandful Agency',
            'phone' => '+994 50 123 45 67',
            'email' => 'info@brandful.az',
            'address' => 'Bakı, Nizami küçəsi 45',
            'description' => 'Marketinq və reklam agentliyi',
            'status' => CompanyStatus::ACTIVE,
        ]);
        Company::create([
            'company_name' => 'Brilliance Cleaning',
            'phone' => '+994 55 987 65 43',
            'email' => 'info@brilliance.az',
            'address' => 'Bakı, 28 May küçəsi 12',
            'description' => 'Təmizlik şirkəti',
            'status' => CompanyStatus::ACTIVE,
        ]);
    }
}

