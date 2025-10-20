<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin default
        User::create([
            'name' => 'Admin OSIS',
            'email' => 'admin@osis.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'has_voted' => false,
        ]);
    }
}
