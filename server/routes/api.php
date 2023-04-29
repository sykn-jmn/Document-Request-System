<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RequestController;
use App\Models\ForgotPassword;
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
    Route::put('/update-user', [UserController::class, 'updateInfo']);
    Route::get('/get-details',[UserController::class, 'index']);
    Route::get('/check-email',[UserController::class, 'checkEmail']);
    Route::get('/request/get-slots',[RequestController::class, 'getSlots']);
});
Route::get('/test', function(){
    $data = ForgotPassword::paginate(3);
    return response()->json($data);

});
include_once 'auth/login.php';

