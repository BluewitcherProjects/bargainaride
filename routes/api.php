<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    Route::post("adduserdetail",[UserController::class,'adduserdetail']);

    });


Route::post("login",[UserController::class,'index'])->name('login');
Route::post("validate_otp",[UserController::class,'otpverify']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
