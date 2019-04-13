<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller {
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index() {
        return view('auth.login');
    }

    public function memberLogin($role) {
        return view('auth.member_login')->with('role', $role);
    }
    
    public function authenticate(Request $request) {
        $login = htmlspecialchars($request->login);
        $password = htmlspecialchars($request->password);
        $role = htmlspecialchars($request->role);

        if($login=='' || $password=='' || $role=='') {
            return redirect()->back()->with('update_error', "Enter both credentials");
        }
        //checking whether user is logging in with username or email
        if(filter_var($login, FILTER_VALIDATE_EMAIL)){
            $field = 'email';
        }else {
            $field = 'username';
        }

        //autherize function
        if (Auth::attempt(['role' => $role, $field => $login, 'password' => $password])) {//auth success
            if(Auth::user()->status!=1) {//check if the user is blocked or not
                Auth::logout();
                return redirect('/')->with('update_error', "You are blocked by the admin. Kindly contact the support +91 x xxx xxxx");
            }
            $msg = '';
            switch($role) {
            	case 'user':
            		$redirectTo = '/';
                    $msg = '. Now continue booking the rooms of your choice';
            		break;
            	case 'admin':
            		$redirectTo = 'dashboard';
            		break;
            	case 'manager':
            		$redirectTo = 'bookings'; 
            		break;
            	default:
            		$redirectTo = '/';
            }
            //user autherized, redirect to respective routes
            return redirect($redirectTo)->with('update_success', 'Welcome back, '.ucwords(Auth::user()->name).$msg);
        }else {
            return redirect()->back()->with('update_error', "Credentials doesn't match");
        }
    }

    public function logout() {
    	switch(Auth::user()->role) {
        	case 'user':
        		$redirectTo = '/';
        		break;
        	case 'admin':
        		$redirectTo = '/admin';
        		break;
        	case 'manager':
        		$redirectTo = '/manager';
        		break;
        	default:
        		$redirectTo = '/';
        }
        Auth::logout();
        return redirect($redirectTo)->with('update_success', "Logged out Successfully");
    }
}