<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            ClientSeeder::class,
            LeadSeeder::class,
            DealSeeder::class,
            PaymentSeeder::class,
            FollowUpSeeder::class,
            ActivitySeeder::class,
        ]);
    }
}

