<?php

namespace App\Http\Controllers;

use App\Modules\UserLogin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(UserLogin $userLogin, Request $request){
        return $userLogin->login($request);
    }
}
