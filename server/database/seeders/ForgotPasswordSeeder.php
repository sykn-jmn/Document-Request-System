<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ForgotPassword;

class ForgotPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i<=10; $i++){
            ForgotPassword::create([
                'user_id' => $i,
                'code' => '3432'
            ]);
        }
        
    }
}
