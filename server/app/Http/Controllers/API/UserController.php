<?php

namespace App\Http\Controllers\API;

use App\Modules\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function index(Users $users, Request $request){
        return response()->json($request->user());
    }
    function store(Users $users, Request $request){
        return $users->store($request);
    }
}
