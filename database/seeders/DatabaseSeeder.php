<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Guard against re-seeding on container restarts/redeploys - once
        // demo data exists (admin user present), skip to keep this command
        // safe to run every deploy without unique-constraint crashes.
        if (User::where('email', 'admin@bizcrm.az')->exists()) {
            $this->command->info('Demo data already seeded, skipping.');
            return;
        }

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
