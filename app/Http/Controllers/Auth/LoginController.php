<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'empno';
    }

    protected function authenticated()
    {
        $user = auth()->user();
        $firstname=$user->firstname;
        $empno=$user->empno;
        if ( $user->isDeactivated==1  ) {
            Auth::logout();
            return view('pages.deactivated')->with('firstname',$firstname);
        }else{
            if($user->ctrlogin==0 ){
                Auth::logout();
                $data=array(
                    'empno'=>$empno,
                    'changeType'=>1
                );
                return view('pages.changepassword')->with($data);
            }else{
                $lastChangedPass =$user->dLastChangePword ;
                $d = strtotime("+3 months",strtotime($lastChangedPass));
                $expiredate=date("Y-m-d",$d);
                $dateNow=date("Y-m-d");
                if($dateNow>=$expiredate){
                    Auth::logout();
                    $data=array(
                        'empno'=>$empno,
                        'changeType'=>2
                    );
                    return view('pages.changepassword')->with($data);
                }else{
                    return redirect('/dashboard');
                }
                    


            }
        }
    }
}
