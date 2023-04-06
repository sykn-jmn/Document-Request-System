<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'email' => 'test@example.com',
            'first_name' => 'Test',
            'middle_name' => 'o',
            'last_name' => 'Example',
            'birthdate' => now(),
            'gender' => 'male',
            'civil_status' => 'single',
            'mobile_number' => '09751304307',
            'mothers_firstname' => 'Jeniza',
            'mothers_middlename' => 'O.',
            'mothers_lastname' => 'Apus',
            'password' => bcrypt('123456789'),
        ]);
    }
}
