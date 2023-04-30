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
            'description' => 'Lorem ipsum'
        ]);

        Document::create([
            'name'=>'Baranggay Health Certificate',
            'description' => 'Lorem ipsum'
        ]);

        Document::create([
            'name'=>'Baranggay Clearance',
            'description' => 'Lorem ipsum'
        ]);

        Document::create([
            'name'=>'Certificate of Residency',
            'description' => 'Lorem ipsum'
        ]);

        Document::create([
            'name'=>'Certificate of Indigency',
            'description' => 'Lorem ipsum'
        ]);
    }
}
