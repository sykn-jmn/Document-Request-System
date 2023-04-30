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
            'email' => 'jumboy@yopmail.com',
            'first_name' => 'Jhumer',
            'middle_name' => 'Ojales',
            'last_name' => 'Apus',
            'birthdate' => now(),
            'sex' => 'male',
            'civil_status' => 'single',
            'mobile_number' => '09751304307',
            'mothers_firstname' => 'Jeniza',
            'mothers_middlename' => 'Ihan',
            'mothers_lastname' => 'Ojales',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
        ]);
    }
}
