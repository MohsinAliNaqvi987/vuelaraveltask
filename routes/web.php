<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::middleware(['username','email','password','confirmPassword'])->post('/vueapp/signup', 'App\Http\Controllers\MainController@signup');

Route::middleware(['loginEmail','loginPassword'])->post('/vueapp/login', 'App\Http\Controllers\MainController@login');

Route::post('/vueapp/googleLogin', 'App\Http\Controllers\MainController@googleLogin');

Route::middleware('forgetEmail')->post('/vueapp/forgetPassword', 'App\Http\Controllers\MainController@forgetPassword');

Route::middleware('newPassword')->post('/vueapp/resetPassword', 'App\Http\Controllers\MainController@resetPassword');

Route::middleware('updateEmail')->post('/vueapp/updateProfile', 'App\Http\Controllers\MainController@updateProfile');

