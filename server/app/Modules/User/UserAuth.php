<?php

namespace App\Modules\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAuth
{
    public function login($payload)
    {

         $user = User::where('id', 1)->first();


        if (!Auth::guard('admin')->attempt($payload)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        // $payload->session()->regenerate();
        return response()->json([
            'message' => Auth::user()
        ], 200);
    }
    public function logout($payload)
        {
            Auth::logout();
            $payload->session()->invalidate();
            $payload->session()->regenerateToken();
        }
}
