<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('seller.auth.login');
    }

    public function login(Request $request){

        if(Auth::guard('seller')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('seller')->with('success','You are successfully Logged in as Seller');
        }
        else{
            return back()->withInput($request->only('email'));
        }
    }
}
