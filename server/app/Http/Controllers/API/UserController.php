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
        return $users->getUser();
    }
    function getDetails(Users $users, Request $request){
        return $users->getDetails();
    }
    function store(Users $users, Request $request){
        return $users->store($request);
    }
    function sendCode(Users $users, Request $request){
        return $users->sendCode($request);
    }
    function verify(Users $users, Request $request){
        return $users->verify($request);
    }
    function verifyCodePassword(Users $users, Request $request){
        return $users->verifyCodePassword($request);
    }
    function updatePassword(Users $users, Request $request){
        return $users->updatePassword($request);
    }
    function updateInfo(Users $users, Request $request){
        return $users->updateInfo($request);
    }
    function uploadPhoto(Users $users, Request $request){
        return $users->uploadPhoto($request);
    }

    function getProfilePic(Users $users, Request $request){
        return $users->getProfilePic();
    }

    function checkEmail(Users $users, Request $request){
        if(!$users->checkEmail($request)){
            return response()->json(["isEmailExist" => false]);
        }else{
            return response()->json(["isEmailExist" => true]);
        }
    }

}
