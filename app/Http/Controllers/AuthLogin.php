<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Email;

class AuthLogin extends Controller
{
    public function AuthUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            

            $dtuser = User::where('email', $credentials['email'])->first();
            

            if( $dtuser->role == "seller"){
                return redirect()->intended('CRUIDSeller');
            } elseif ($dtuser->role == "buyer") {
                return redirect()->intended('ProductLogin');
            }
            
        }
 
        return back()->withErrors([
            'email' => 'The email and/or password is incorrect !!',
        ])->onlyInput('email');
    }
}