<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $brandful = Company::where('company_name', 'Brandful Agency')->first();
        $brilliance = Company::where('company_name', 'Brilliance Cleaning')->first();

        User::create([
            'name' => 'Sistem Admin',
            'email' => 'admin@bizcrm.az',
            'password_hash' => Hash::make('admin123'),
            'role' => Role::SUPER_ADMIN,
        ]);
        User::create([
            'name' => 'Aysel Məmmədova',
            'email' => 'aysel@brandful.az',
            'password_hash' => Hash::make('menecer123'),
            'role' => Role::MENEGER,
            'company_id' => $brandful->id,
        ]);
        User::create([
            'name' => 'Rəşad Əliyev',
            'email' => 'reshad@brandful.az',
            'password_hash' => Hash::make('satis123'),
            'role' => Role::SATIS_EMKDAS,
            'company_id' => $brandful->id,
        ]);
        User::create([
            'name' => 'Leyla Hüseynova',
            'email' => 'leyla@brilliance.az',
            'password_hash' => Hash::make('menecer123'),
            'role' => Role::MENEGER,
            'company_id' => $brilliance->id,
        ]);
    }
}

