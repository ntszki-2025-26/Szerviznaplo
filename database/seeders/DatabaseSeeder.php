<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        'email' => 'user@gmail.com',
        'password' => Hash::make('User12345'),
        'username' => 'User',
        'first_name' => 'User',
        'last_name' => 'User',
        'role' => '0',
        ]);
        User::factory()->create([
        'email' => 'admin@gmail.com',
        'password' => Hash::make('Admin12345'),
        'username' => 'Admin',
        'first_name' => 'Admin',
        'last_name' => 'Admin',
        'role' => '2',
        ]);

        User::factory()->create([
        'email' => 'mechanic@gmail.com',
        'password' => Hash::make('Mechanic12345'),
        'username' => 'Mechanic',
        'first_name' => 'Mechanic',
        'last_name' => 'Mechanic',
        'role' => '1',
        ]);

        DB::table('status')->insert([
            ['status' => 'Függőben']
        ]);
        DB::table('status')->insert([
            ['status' => 'Folyamatban']
        ]);
       
        DB::table('status')->insert([
            ['status' => 'Kész']
        ]);
       
       
        
    }
}
