<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
class SignupController extends Controller {
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function index(Request $request) {
        $name = htmlspecialchars($request->accountName);
        $email = htmlspecialchars($request->accountEmail);
        $username = htmlspecialchars($request->accountUsername);
        $password = htmlspecialchars($request->accountPassword);

        if($name=='' || $email== '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || User::where('email', $email )->exists() || $username=='' || User::where('username', $username )->exists() || $password=='') {
            return redirect()->back()->with('update_error', "Enter both credentials");
        }

        //now insert into database
        $cdate = date('Y-m-d H:i:s');
        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->created_at = $cdate;
        $user->updated_at = $cdate;

        $user->save();
        if($user->id) {//insert success, mow login the user
            $res = $this->authenticateUser($email,$password);
            return redirect('/')->with($res['res'], $res['msg']);
        }else {
            return redirect()->back()->with('update_error', "Something went wrong while creating the account. Please try again");
        }
    }
    
    private function authenticateUser($email,$pass) {
        //autherize function
        if (Auth::attempt(['role' => 'user', 'email' => $email, 'password' => $pass])) {//auth success
            if(Auth::user()->status!=1) {//check if the user is blocked or not
                Auth::logout();
                return array('res' => 'update_error', 'msg' => "You are blocked by the admin. Kindly contact the support +91 x xxx xxxx");
            }
            //user autherized, redirect to respective route
            return array('res' => 'update_success', 'msg' => 'Greatings, '.ucwords(Auth::user()->name).'. Now continue booking the rooms of your choice');
        }else {
             return array('res' => 'update_error', 'msg' => "Credentials doesn't match");
        }
    }
}