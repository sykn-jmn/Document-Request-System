<?php

namespace App\Http\Controllers;

use App\Modules\User\UserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(UserAuth $userAuth, Request $request){
        return $userAuth->login($request);
    }

    public function logout(UserAuth $userAuth, Request $request){
        return $userAuth->logout($request);
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
    ]);
    }
}
