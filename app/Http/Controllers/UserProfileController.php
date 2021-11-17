<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index(){
        return view('admin.userpro.index');
    }

    public function AddProfile(Request $request){
        $request->validate([
            'user_email' => 'required|max:255',
            'user_name' =>'required|max:8',
        ],
        [
            'user_email.required' => 'Please Input Valid Email',
            'user_name.required' => 'Please Input Valid Username',
            'user_name.max' => 'Please Input Username within maximum 8 letters',
        ]
    );
    // Update Profile

    $up_id=Auth::User()->id;
    User::find($up_id)->update([
        'name'=>$request->user_name,
        'email'=>$request->user_email,
    ]);

    return Redirect()->back()->with('Success','Profile Update Successfully');
    }

    public function ChangePassword(){
        return view('admin.userpro.changepass');
    }
    public function UpdatePass(Request $request){

        $id=Auth::user()->id;
        $old_pass=$request->old_pass;
        $new_pass=$request->new_pass;
        $confirm_pass=$request->confirm_pass;
        $db_pass=Auth::user()->password;

        if(Hash::check($db_pass, $old_pass)){
            if($new_pass===$confirm_pass){
                User::find($id)->update([
                    'password'=>Hash::make($request->new_pass)
                ]);
                Auth::logout();
                return Redirect()->route('user.profile');
            }else{
                return Redirect()->back()->with('danger','Confirm Password And New Password Not match');
            }
        }else{
            return Redirect()->back()->with('error','Type Exact Old Password');
        }
    }
}


