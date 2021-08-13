<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin-register', [RegisterController::class, 'adminRegister']);
Route::post('/register', [RegisterController::class, 'userRegister']);
Route::post('/profile', [RegisterController::class, 'profile']);
Route::post('/profile-update', [RegisterController::class, 'profileUpdate']);
Route::post('/login', [RegisterController::class, 'userLogin']);
Route::post('/forgot-passwordchange',[RegisterController::class,'changePassword']);
Route::post('/verifyotp', [RegisterController::class, 'verifyOtp']);
Route::post('/update-password', [RegisterController::class, 'newPassword']);




