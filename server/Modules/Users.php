<?php

namespace App\Modules;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Users
{
    public function login($payload)
    {
        return response()->json(['ulol'=>'hi']);
    }
}
