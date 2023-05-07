<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AdminRequestController;
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
        Route::get('/admin', function(){
            return response()->json(['message'=>'ola soy dora']);
        });
        Route::get('/test',function(){
            return response()->json(['message' => 'success']);
        });
    });
    Route::prefix('user')->group(function(){
        Route::get('/get-details', [UserController::class, 'getDetails']);
        Route::post('/store', [UserController::class, 'store']);
        Route::get('send-code', [UserController::class, 'sendCode']);
        Route::put('verify-account', [UserController::class, 'verify']);
        Route::get('/verify-code-password', [UserController::class, 'verifyCodePassword']);
        Route::put('/update-password', [UserController::class, 'updatePassword']);
        Route::put('/update-user', [UserController::class, 'updateInfo']);
        Route::get('/check-email',[UserController::class, 'checkEmail']);
        Route::get('/request/get-slots',[RequestController::class, 'getSlots']);
        Route::get('/documents', [RequestController::class, 'getDocuments']);
        Route::post('/submit-request', [RequestController::class, 'submitRequest']);
        Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
        Route::get('/profile-pic', [UserController::class, 'getProfilePic']);
        Route::get('/get-request/{status}', [RequestController::class, 'index']);
        Route::get('/count-request', [RequestController::class, 'countRequest']);
    });
    
    
});

Route::prefix('admin')->group(function(){
    Route::get('/get-details', [AdminController::class, 'getDetails']);
    Route::post('/store', [AdminController::class, 'store']);
    Route::get('send-code', [AdminController::class, 'sendCode']);
    Route::put('verify-account', [AdminController::class, 'verify']);
    Route::get('/verify-code-password', [AdminController::class, 'verifyCodePassword']);
    Route::put('/update-password', [AdminController::class, 'updatePassword']);
    Route::put('/update-user', [AdminController::class, 'updateInfo']);
    Route::get('/check-email',[AdminController::class, 'checkEmail']);
    Route::get('/request/get-slots',[AdminRequestController::class, 'getSlots']);
    Route::get('/documents', [AdminRequestController::class, 'getDocuments']);
    Route::post('/submit-request', [AdminRequestController::class, 'submitRequest']);
    Route::post('/upload-photo', [AdminController::class, 'uploadPhoto']);
    Route::get('/profile-pic', [AdminController::class, 'getProfilePic']);
    Route::get('/get-request/{status}', [AdminRequestController::class, 'index']);
    Route::get('/count-request', [AdminRequestController::class, 'countRequest']);
});




Route::get('/test', function(){
    $data = ForgotPassword::paginate(3);
    return response()->json($data);

});
include_once 'auth/login.php';

