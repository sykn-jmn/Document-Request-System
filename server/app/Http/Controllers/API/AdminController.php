<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admins;

class AdminController extends Controller
{
    function index(Admins $admins, Request $request){
        return $admins->getUser();
    }
    function resendEmail(Admins $admins, Request $request){
        return $admins->resendEmail($request);
    }
    function getDetails(Admins $admins, Request $request){
        return $admins->getDetails();
    }
    function store(Admins $admins, Request $request){
        return $admins->store($request);
    }
    function sendCode(Admins $admins, Request $request){
        return $admins->sendCode($request);
    }
    function verify(Admins $admins, Request $request){
        return $admins->verify($request);
    }
    function verifyCodePassword(Admins $admins, Request $request){
        return $admins->verifyCodePassword($request);
    }
    function updatePassword(Admins $admins, Request $request){
        return $admins->updatePassword($request);
    }
    function changePassword(Admins$admins, Request $request){
        return $admins->changePassword($request);
    }
    function updateInfo(Admins $admins, Request $request){
        return $admins->updateInfo($request);
    }
    function uploadPhoto(Admins $admins, Request $request){
        return $admins->uploadPhoto($request);
    }

    function getProfilePic(Admins $admins, Request $request){
        return $admins->getProfilePic();
    }

    function checkEmail(Admins $admins, Request $request){
        if(!$admins->checkEmail($request)){
            return response()->json(["isEmailExist" => false]);
        }else{
            return response()->json(["isEmailExist" => true]);
        }
    }
}
