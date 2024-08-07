<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin FIC7',
            'email' => 'admin@fic7.id',
            'role' => 'admin',
            'email_verified_at' => now(),
            'unhashed_password' => 'password',
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();
    }
}
