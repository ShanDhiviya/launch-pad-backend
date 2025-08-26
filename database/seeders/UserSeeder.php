<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@launchpad.com',
            'password' => 'password',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@launchpad.com',
            'password' => 'password',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Manager User',
            'email' => 'manager@launchpad.com',
            'password' => 'password',
            'role_id' => 3,
        ]);
    }
}
