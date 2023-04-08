<?php

namespace App\Http\Controllers;

use App\Modules\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Authenticate $auth, Request $request){
        return $auth->userLogin($request);
        
    }

    // public function logout(Authenticate $auth, Request $request){
    //     return $auth->logout($request);
    // }

    // public function me(Request $request)
    // {
    //     return response()->json([
    //         'data' => Auth::guard('users')->user(),
    // ]);
    // }
}
