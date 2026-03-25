<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
        'email' => 'User@gmail.com',
        'password' => Hash::make('User12345'),
        'username' => 'User',
        'first_name' => 'User',
        'last_name' => 'User',
        'role' => 'user',
        ]);
        User::factory()->create([
        'email' => 'Admin@gmail.com',
        'password' => Hash::make('Admin12345'),
        'username' => 'Admin',
        'first_name' => 'Admin',
        'last_name' => 'Admin',
        'role' => 'admin',
        ]);
    }
}
