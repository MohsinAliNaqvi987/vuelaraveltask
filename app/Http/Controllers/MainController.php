<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\ForgetRequest;
use DateTime;
use DateInterval;
use App\Mail\SendEmail;
use Illuminate\Http\JSONResponse;

class MainController extends Controller
{
    public static function signup (Request $req) {
                $user = new User();
                $user->username = $req->username;
                $user->email = $req->email;
                $user->password = $req->password;
                $user->confirmPassword = $req->confirmPassword;
                $user->DOB = null;
                $user->image = '';
                $user->Education = '';
                $user->save();
                $userObj = User::where('email',$req->email)->first();
                return new JSONResponse(['status' => 'ok', 'data'=>$userObj] ,200);
    }

    public function login(Request $req){
        $user = User::where('email',$req->email)->where('password',$req->password)->first();
        if ($user != null)
            return new JSONResponse(['status' => 'ok', 'data'=>$user] ,200);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Wrong email or password'] ,400);
    }

    public function googleLogin(Request $req){
        $user = User::where('email',$req->email)->first();
        if ($user != null)
            return new JSONResponse(['status' => 'ok', 'data'=>$user] ,200);
        else
            return new JSONResponse(['status' => 'error', 'error'=>'Cannot login through Google, Signup required'] ,400);
    }

    public function forgetPassword (Request $req) {
        $pinCode = rand(pow(10, 3), pow(10, 4)-1);
        date_default_timezone_set("Asia/Karachi");
        $currentDateAndTime = new DateTime('Now');
        $expiryDateAndTime = $currentDateAndTime->add(new DateInterval('PT3600S'));
        $forgetRequest = new ForgetRequest();
        $forgetRequest->email = $req->email;
        $forgetRequest->pinCode = $pinCode;
        $forgetRequest->expiryTime = $expiryDateAndTime;
        $forgetRequest->save();
        Mail::to($req->email)->send(new SendEmail($pinCode));
        return new JSONResponse(['status' => 'ok', 'message'=>'Check your email'] ,200);
    }

    public function updateProfile (Request $req) {
        $user = User::where('email', $req->email)->first();
        $user->username = $req->newName;
        $user->DOB = $req->dob;
        $file = $req->file('image');
        $originalName = $file->getClientOriginalName();
        $file->move('imageFolder',$originalName);
        $user->image = $originalName;
        $user->Education = $req->education;
        $user->save();
        $userObj = User::where('email',$req->email)->first();
        return new JSONResponse(['status' => 'ok', 'data'=>$userObj] ,200);
    }

    public function resetPassword(Request $req){
        date_default_timezone_set("Asia/Karachi");
        $currentDateAndTime = new DateTime('Now');
        $forgetRequest = ForgetRequest::where('pinCode', $req->pinCode)->where('expiryTime', '>', $currentDateAndTime)->first();
        if($forgetRequest != null){
            $user = User::where('email', $forgetRequest->email)->first();
            $user->password = $req->newPassword;
            $user->save();
            return new JSONResponse(['status' => 'ok', 'message'=>'Password Reset Successfully'] ,200);
        }
        else
            return new JSONResponse(['status' => 'error', 'error'=>'This pincode is wrong or expired. Try again!'] ,400);
    }

}
