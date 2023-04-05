<?php

namespace App\Modules;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    public function userLogin($payload)
    {
        $data = [
            'email'=> $payload->email,
            'password'=>$payload->password
        ];
        
        if (!Auth::guard('users')->attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        $user = Auth::guard('users')->user();
        $token = $user->createToken('access_token')->plainTextToken;
        return response()->json([
            'token' =>  $token,
        ]); 
    }

    public function adminLogin($payload)
    {
        $data = [
            'email'=> $payload->email,
            'password'=>$payload->password
        ];
        
        if (!Auth::guard('admins')->attempt($data)) {
            return false;
        }

        return true;
    }

    public function logout($payload)
        {
            Auth::logout();
            $payload->session()->invalidate();
            $payload->session()->regenerateToken();
        }
}
