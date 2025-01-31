<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function RegUser(Request $request){
        $add_user = new User();
        $add_user->name = $request->name;
        $add_user->username = $request->username;
        $add_user->password = $request->password;
        $add_user->email = $request->email;
        $add_user->admin = false;
        $add_user->role = 'buyer';
        $add_user->save();

        return view('home');
        
    }
}