<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard(){
        if(Auth::check()){
            return view('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }

    public function authenticate(Request $request){

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            return redirect()->intended('admin');
        }

        return redirect()->route('admin.login');
    }

    public function showLoginForm(){
        if(Auth::check()){
            return view('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function deauthenticate(){
        Auth::logout();

        return redirect()->route('admin.login');
    }

}
