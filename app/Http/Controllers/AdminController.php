<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function log_in(AdminRequest $request, User $user)
        {
            $userinfo = User::where('email','=',$request->email)->first();

        if(!$userinfo){
            return back()->with('fail','We do not recognize your email');
        }else{
            if(Hash::check($request->password,$userinfo->password) && $userinfo->role === "user"){
                $request->session()->put('loggedUser',$userinfo->id);
                return view('admin.admin');
            }else{
                return back()->with('fail','Incorrect Password');
            }
        }

        }
}
