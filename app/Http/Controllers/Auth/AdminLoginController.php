<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin');
	}

    public function showLoginForm(){
    	return view('auth.admin_login');
    }

    public function Login(Request $request){
    	//validate form data
    	$this->validate($request,[
    			'email'=> 'required|email',
    			'password'=>'required|min:6'
    	]);

    	//attempt to log the user in
    	if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
    		//if succesful, redirect to intended page
    		return redirect()->intended(route('admin.dashboard'));
    	} 	
    	//else redirect to login form with form data
    	return redirect()->back()->withInput($request->only('email','remember'));
    }
}
