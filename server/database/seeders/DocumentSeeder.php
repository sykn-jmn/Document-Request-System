<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::create([
            'name'=>'Cedula',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'barangay Health Certificate',
            'description' => 'Lorem ipsum',
            'fee' => 10.00
        ]);

        Document::create([
            'name'=>'barangay Clearance',
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
