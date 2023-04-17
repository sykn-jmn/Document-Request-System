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

        $checkEmail = User::where('email',$payload->email)->first();
        if($checkEmail){
            if(!$checkEmail->email_verified_at){
                return response(['message'=>'email is not verified'], 500);
            }
        }else{
            return response(['message'=>'no email exist'], 500);
        }
        
        if (!Auth::guard('users')->attempt($data)) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        $user = Auth::guard('users')->user();
        if($user->email_verified_at == null){
            return response()->json(['message'=>'Please verify your email address first']);
        }
        $token = $user->createToken('access_token')->plainTextToken;
        $response = [
            'token' =>  $token,
        ];
        return response()->json($response);
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
