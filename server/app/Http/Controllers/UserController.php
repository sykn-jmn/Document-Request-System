<?php

namespace App\Http\Controllers;

use App\Modules\User\UserLogin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request, UserLogin $userLogin){
        return $userLogin->login($request);
    }
}
