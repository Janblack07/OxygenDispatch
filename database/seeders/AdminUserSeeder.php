<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\AppRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@local.test'],
            [
                'name' => 'ADMINISTRADOR',
                'password' => Hash::make('Admin123!'),
                'role' => AppRole::ADMINISTRADOR->value,
                'is_active' => true,
            ]
        );
    }
}
