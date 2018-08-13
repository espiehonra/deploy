<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rules\ValidOldPassword;
use Auth;
use Hash;


class PasswordController extends Controller
{
    public function index(){    
      return view('pages.changepassword');
    }

    public function chkpword(){
      $user = User::where('empno', $_GET['empno'])->first();
      if (Hash::check($_GET['cpassword'], $user->password)) {
        if(Hash::check($_GET['password'], $user->password)){
          echo 2;
        }else{
          echo 1;
          $npword=Hash::make($_GET['password']);
          $ndate = date('Y-m-d');
          User::where('empno', $_GET['empno'])->update(['password' => $npword,'dLastChangePword'=>$ndate,'ctrlogin'=>1]);
        }
      }else{
        echo 0;
      }
    }
   
    public function update(Request $request)
    {

        $this->validate($request, [
          'cpassword' => 'required',
          'password' => 'required|string|min:6|confirmed',
          ]);
        $oldpword=$request->input('old_pword');
        if (Hash::check($oldpword, $request->input('cpassword'))) {
            echo "true";
        }else{
            echo "false";
        }

        $user=new User;
        echo "test".$request->input('cpassword')."-".$request->input('old_pword');
        /*
        $slide->maintitle=$request->input('mainTitle');
        $slide->subtitle=$request->input('subTitle');
        $slide->save();
        return redirect('/slides');
        */
    }

   
}
