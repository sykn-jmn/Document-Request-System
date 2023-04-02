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
        $data = [
            'email'=> $payload->email,
            'password'=>$payload->password
        ];

        //  return response()->json($payload);
         $user = User::where('id', 1)->first();


        if (!Auth::guard('users')->attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        Log::info('hello');
        Log::info(Auth::guard('users')->user());
        // $payload->session()->regenerate();
        return response()->json([
            'message' => 'success'
        ], 200);
    }
    public function logout($payload)
        {
            Auth::logout();
            $payload->session()->invalidate();
            $payload->session()->regenerateToken();
        }
}
