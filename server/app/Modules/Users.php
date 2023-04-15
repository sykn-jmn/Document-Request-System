<?php

namespace App\Modules;

use App\Models\User;
use App\Models\ForgotPassword as ForgotPasswordModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword as ForgotPasswordMail;
use App\Mail\SignUp;
use App\Http\Traits\GenerateCodeTrait;
use Carbon\Carbon;

class Users
{
    use GenerateCodeTrait;
    public function store($payload)
    {
        $rules = array(
            'email' => 'required|max:255|email',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'mobile_number' => 'required|string|min:11',
            'mothers_firstname' => 'required|string',
            'mothers_middlename' => 'required|string',
            'mothers_lastname' => 'required|string',
            'password' => 'required|string|min:8',
        );

        $validator = Validator::make($payload->all(), $rules);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors()]);
        }

        //generate code for verification
        $emailCode = $this->generateCode(). $userTransaction->id;

        $data = array(
            'email' => $payload->email,
            'first_name' => $payload->first_name,
            'middle_name' => $payload->middle_name,
            'last_name' => $payload->last_name,
            'birthdate' => $payload->birthdate,
            'gender' => $payload->gender,
            'civil_status' => $payload->civil_status,
            'mobile_number' => $payload->mobile_number,
            'mothers_firstname' => $payload->mothers_firstname,
            'mothers_middlename' => $payload->mothers_middlename,
            'mothers_lastname' => $payload->mothers_lastname,
            'email_code' => $emailCode,
            'password' => bcrypt($payload->password),
        );

        DB::beginTransaction();

        $userTransaction = User::create($data);

        if(!$userTransaction){
           DB::rollback();
        }
        DB::commit();
        
        //send verification email
        $url = 'http://localhost:3000/verify-account/'.$emailCode;
        Mail::to($payload->email)->send(new SignUp($url));

        return response()->json(["message"=>"user created successfully"]);
    }
    public function checkEmail($payload){
        $email = $payload->email;
        $isEmailExist = User::where('email', $email)->first();
        if(!$isEmailExist){
            return response()->json(['isEmailExist'=>false]);
        }
        
        $code = $this->generateCode();

        $storeCode = array(
            'user_id' => $isEmailExist->id,
            'code' => $code
        );
        ForgotPasswordModel::create($storeCode);
        Mail::to($email)->send(new ForgotPasswordMail($code));
        return response()->json(['isEmailExist'=>true]);
    }

}
