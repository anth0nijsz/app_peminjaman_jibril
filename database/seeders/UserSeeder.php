<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@peminjaman.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_identitas' => '1234567890123456',
            'alamat' => 'Jl. Admin No. 1',
            'no_telepon' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // Operator user
        User::create([
            'name' => 'Operator',
            'email' => 'operator@peminjaman.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'no_identitas' => '1234567890123457',
            'alamat' => 'Jl. Operator No. 2',
            'no_telepon' => '081234567891',
            'email_verified_at' => now(),
        ]);

        // Member users
        User::create([
            'name' => 'Member 1',
            'email' => 'member1@peminjaman.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'no_identitas' => '1234567890123458',
            'alamat' => 'Jl. Member No. 3',
            'no_telepon' => '081234567892',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Member 2',
            'email' => 'member2@peminjaman.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'no_identitas' => '1234567890123459',
            'alamat' => 'Jl. Member No. 4',
            'no_telepon' => '081234567893',
            'email_verified_at' => now(),
        ]);
    }
}
