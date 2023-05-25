<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\ResidentController;
use App\Http\Controllers\API\AdminRequestController;
use App\Http\Controllers\API\RequestController;
use App\Models\ForgotPassword;
use Illuminate\Support\Facades\Storage;
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
            return response()->json(Auth::user());
        });
        
        Route::get('/test',function(){
            return response()->json(Auth::user());
        });
    });
    Route::prefix('user')->group(function(){
        
        Route::get('/profile-pic', [UserController::class, 'getProfilePic']);
        Route::get('/get-details', [UserController::class, 'getDetails']);
        
        Route::prefix('account')->group(function(){
            Route::put('change-password', [UserController::class, 'changePassword']);
            Route::put('/update-user', [UserController::class, 'updateInfo']);
            Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
        });
        Route::prefix('request')->group(function(){
            Route::get('/get-request/{id}', [RequestController::class, 'getRequest']);
            Route::get('/get-slots',[RequestController::class, 'getSlots']);
            Route::get('/documents', [RequestController::class, 'getDocuments']);
            Route::post('/submit-request', [RequestController::class, 'submitRequest']);
            Route::get('/get-requests/{status}', [RequestController::class, 'index']);
            Route::delete('/delete-request/{id}', [RequestController::class, 'deleteRequest']);
            Route::put('/update-request', [RequestController::class, 'updateRequest']);
            Route::get('/get-pdf/{path}', [AdminRequestController::class, 'getPDF']);
        });
        Route::prefix('dashboard')->group(function(){
            Route::get('/count-request', [RequestController::class, 'countRequest']);
        });
    });

    Route::prefix('admin')->group(function(){

        Route::get('/profile-pic', [AdminController::class, 'getProfilePic']);
        Route::get('/get-details', [AdminController::class, 'getDetails']);
        Route::get('/get-all-reports', [AdminRequestController::class, 'getAllReports']);
        Route::post('/store', [AdminController::class, 'store']);

        Route::prefix('residents')->group(function(){
            Route::get('get-all-residents/{filter}',[ResidentController::class, 'index']);
        });
        
        Route::prefix('account')->group(function(){
            Route::put('change-password', [AdminController::class, 'changePassword']);
            Route::put('/update-user', [AdminController::class, 'updateInfo']);
            Route::post('/upload-photo', [AdminController::class, 'uploadPhoto']);
        });
        Route::prefix('request')->group(function(){
            Route::get('/documents', [RequestController::class, 'getDocuments']);
            Route::get('/get-requests/{status}', [AdminRequestController::class, 'index']);
            Route::get('/get-request/{id}', [AdminRequestController::class, 'getRequestDetails']);
            Route::get('/get-pdf/{path}', [AdminRequestController::class, 'getPDF']);
            Route::put('/update-status', [AdminRequestController::class, 'updateRequestStatus']);
        });
        Route::prefix('dashboard')->group(function(){
            Route::get('/get-reports', [AdminRequestController::class, 'getReports']);
            Route::get('/count-request', [AdminRequestController::class, 'countRequest']);
            Route::get('/count-residents', [AdminRequestController::class, 'countResidents']);
        });
        
    });
});

Route::prefix('user')->group(function(){
    Route::post('/store', [UserController::class, 'store']);
    Route::post('/resend-email', [UserController::class, 'resendEmail']);
    Route::get('/check-email',[UserController::class, 'checkEmail']);
    Route::get('/send-code', [UserController::class, 'sendCode']);
    Route::put('verify-account', [UserController::class, 'verify']);
    Route::get('/verify-code-password', [UserController::class, 'verifyCodePassword']);
    Route::put('/update-password', [UserController::class, 'updatePassword']);

});

Route::get('send-code', [AdminController::class, 'sendCode']);
Route::put('verify-account', [AdminController::class, 'verify']);
Route::get('/verify-code-password', [AdminController::class, 'verifyCodePassword']);


Route::get('/test/get-pdf',function(){
    $file = Storage::get('public/supporting_documents/1683819565_RESUME - APUS.pdf');
    return $file;
    
    // return response()->json(['path'=>$link]);
});




// Route::get('/test', function(){
//     Log::info(Auth::user());
//     return response()->json(Auth::user());
// });
include_once 'auth/login.php';

