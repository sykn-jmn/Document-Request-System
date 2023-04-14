<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/message', function () {
    return response()->json(["message"=>"hi"]);
});

Route::get('/email', function(){
    Mail::to('jumboy@yopmail.com')->send(new ForgotPassword());
    return new ForgotPassword();
});