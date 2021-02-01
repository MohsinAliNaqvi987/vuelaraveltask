<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JSONResponse;

class MainController extends Controller
{
    public function signup (Request $req) {
                $user = new User();
                $user->username = $req->username;
                $user->email = $req->email;
                $user->password = $req->password;
                $user->confirmPassword = $req->confirmPassword;
                $user->DOB = null;
                $user->image = '';
                $user->Education = '';
                $user->save();
                return new JSONResponse(['status' => 'ok', 'message'=>'Successfully Signed Up'] ,200);
    }

    public function forgetPassword (Request $req) {
        $user = User::where('email', $req->email)->first();
        $user->password = $req->newPassword;
        $user->save();
        return new JSONResponse(['status' => 'ok', 'message'=>'Password Reset Successfully'] ,200);
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
        return new JSONResponse(['status' => 'ok', 'message'=>'Updated Profile Successfully'] ,200);
    }


}
