<?php
namespace App\Http\Traits;



trait GenerateCodeTrait {
    public function generateCode() {
        // Fetch all the students from the 'student' table.
        $characters = '0123456789';
        $randomString = '';
 
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
 
    return $randomString;
    }
}