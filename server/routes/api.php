<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->group(function(){
        Route::get('/user', [UserController::class, 'index']);
    });
});

Route::prefix('user')->group(function(){
    Route::post('store', [UserController::class, 'store']);
    Route::get('send-code', [UserController::class, 'sendCode']);
    Route::put('verify-account', [UserController::class, 'verify']);
    Route::get('/verify-code-password', [UserController::class, 'verifyCodePassword']);
    Route::put('/update-password', [UserController::class, 'updatePassword']);
});
Route::get('/test', function(){
    return response()->json(["message"=>"success"]);
});
include_once 'auth/login.php';
