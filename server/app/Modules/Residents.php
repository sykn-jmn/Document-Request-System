<?php

namespace App\Modules;
use App\Models\User;

class Residents
{
    public function getAllResidents($filter){
        $user = User::select(
            'first_name',
            'middle_name',
            'last_name',
            'email_verified_at',
            'sex',
            'mobile_number',
            'email',
            'purok',
            'barangay',
            'municipality',
            'province'
        )->get();
        return response()->json($user);
    }
}