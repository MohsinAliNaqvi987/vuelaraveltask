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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['username','email','password','confirmPassword'])->post('/vueapp/signup', 'App\Http\Controllers\MainController@signup');

Route::middleware(['forgetEmail','newPassword'])->post('/vueapp/forgetPassword', 'App\Http\Controllers\MainController@forgetPassword');

Route::middleware('updateEmail')->post('/vueapp/updateProfile', 'App\Http\Controllers\MainController@updateProfile');
