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
        $add_user->alamat_pengiriman = $request->alamat_pengiriman;
        $add_user->no_HP = $request->no_HP;
        $add_user->role = 'buyer';
        $add_user->save();

        return view('home');
        
    }

    public function RegSeller(Request $request){
        $add_seller = new User();
        $add_seller->name = $request->name;
        $add_seller->username = $request->username;
        $add_seller->password = $request->password;
        $add_seller->email = $request->email;
        $add_seller->role = $request->role;
        $add_seller->save();

        return view('home');

        
    }
}