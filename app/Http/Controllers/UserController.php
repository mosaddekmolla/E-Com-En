<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $userData= User::where(['email'=>$req->email])->first();
        // return $userEmail->password;
        if(!$userData || !Hash::check($req->password, $userData->password))
        {
            return "UserName and Password does not matched";
        }
        else{
            $req->session()->put('user', $userData);
            return redirect('/');
        }
    }

    function userRegistration(Request $req)
    {
        $user = new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
        return redirect('/login');

    }

}
