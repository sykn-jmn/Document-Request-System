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

        if (!Auth::attempt($payload)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        $request->session()->regenerate();
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
