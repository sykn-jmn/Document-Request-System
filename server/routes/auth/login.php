<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Log;

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

Route::post('/auth/login', [AuthController::class, 'userLogin']);
// Route::post('/auth/login', function(){
//     return response()->json(['hi'=>'hi']);
// });


Route::post('/auth/logout', [AuthController::class, 'userLogout']);

Route::post('/auth/admin/login', [AuthController::class, 'adminLogin']);
// Route::post('/auth/login', function(){
//     return response()->json(['hi'=>'hi']);
// });


Route::post('/auth/admin/logout', [AuthController::class, 'adminLogout']);

