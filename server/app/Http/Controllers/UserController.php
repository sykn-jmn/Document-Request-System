<?php

namespace App\Http\Controllers;

use App\Modules\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Users $userLogin, Request $request){
        return $userLogin->login($request);
    }
}
