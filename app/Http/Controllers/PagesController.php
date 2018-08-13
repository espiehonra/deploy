<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    public function changepassword(){
        $user = Auth::user();
        $token=auth()->user()->remember_token;
        return view('auth.passwords.reset')->with('token',$token);
    }

    public function doLogout()
    {
        $user = Auth::user();
        $id=auth()->user()->id;
        $user->isLogin =0;
        $user->save();

        Auth::logout(); // log the user out of our application
        return Redirect::to('/login'); // redirect the user to the login screen
    }

    public function deactivated(){
        $user = Auth::user();
        $firstname=auth()->user()->firstname;
        return view('pages.deactivatedAcctPage')->with('firstnames',$firstname);
    }

    
}
