<?php

namespace App\Modules;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Users
{
    public function fetchUser()
    {
        return response()->json(Auth::guard('users')->user()); 
    }

}
