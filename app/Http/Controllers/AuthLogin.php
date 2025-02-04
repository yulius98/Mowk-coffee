<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        

        $dt_product_login = DB::table('tblproducts')
                        ->paginate(10);

        if (Auth::attempt($credentials)) {
                
            $request->session()->regenerate();
            

            $dtuser = User::where('email', $credentials['email'])->first();
            

            if( $dtuser->role == "seller"){
                return redirect()->intended('CRUIDSeller')->with('userId', $dtuser->id);

            } elseif ($dtuser->role == "buyer") {
                // Mengirimkan objek pengguna ke view
                
            return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'user' => $dtuser,'product' => $dt_product_login]);
            }
            
        }
 
        return back()->withErrors([
            'email' => 'The email and/or password is incorrect !!',
        ])->onlyInput('email');
    }

    public function Logout(Request $request) 
    {
        Auth::logout();
        $request -> session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()-> intended('Login');

    }


}