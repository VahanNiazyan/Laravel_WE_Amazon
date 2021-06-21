<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
//use http\Client\Curl\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
//use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
         return view('password.change_password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return  redirect('/change_password')->with('error', 'Current password does not match');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/change_password')->with('success', 'Password successfully change');
    }
}
