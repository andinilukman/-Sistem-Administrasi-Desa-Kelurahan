<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Desa',
            'username' => 'admin',
            'email' => 'admin@desa.id',
            'password' => Hash::make('admin123'),
            'role' => 'Admin'
        ]);

        User::create([
            'name' => 'Ahmad Hidayat',
            'username' => 'kepaladesa',
            'email' => 'kepaladesa@desa.id',
            'password' => Hash::make('kepala123'),
            'role' => 'Kepala Desa'
        ]);
    }
}
