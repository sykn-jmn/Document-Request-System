<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use App\Models\Document;
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
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => 'Purok-9',
            'barangay' => 'Linangkayan',
            'municipality' => 'Naawan',
            'province' => 'Misamis Oriental',
            'zip_code' => '9023',
            'mothers_firstname' => 'Jeniza',
            'mothers_middlename' => 'Ihan',
            'mothers_lastname' => 'Ojales',
            'fathers_firstname' => 'Rumir',
            'fathers_middlename' => 'Dadole',
            'fathers_lastname' => 'Apus',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);
        Admin::create([
            'email' => 'admin@edokumento.com',
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'birthdate' => '2000-02-22',
            'sex' => 'male',
            'civil_status' => 'single',
            'suffix' => '',
            'position' => 'Admin',
            'citizenship' => 'Filipino',
            'mobile_number' => '09751304307',
            'purok' => 'Purok-9',
            'barangay' => 'Linangkayan',
            'municipality' => 'Naawan',
            'province' => 'Misamis Oriental',
            'zip_code' => '9023',
            'mothers_firstname' => 'Jeniza',
            'mothers_middlename' => 'Ihan',
            'mothers_lastname' => 'Ojales',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
        ]);

        Document::create([
            'name'=>'Cedula',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'Barangay Permit',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'Barangay Clearance',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'Barangay Business Clearance',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'Certificate of Residency',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'Certificate of Indigency',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);
    
    }
}
