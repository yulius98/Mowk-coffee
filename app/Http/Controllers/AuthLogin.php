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

        $data_carousel = DB::table('carousels')->get();                

        if (Auth::attempt($credentials)) {
                
            $request->session()->regenerate();
            

            $dtuser = User::where('email', $credentials['email'])->first();

            $data_biji_kopi = DB::table('tblproducts')->paginate(10);
            
            $data_carousel = DB::table('carousels')->get();

            if( $dtuser->role == "seller"){
                // Mengirimkan objek pengguna ke view
                return view('CRUIDSeller', ['title' => 'Welcome '.$dtuser->name, 'user' => $dtuser,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi]);
            } elseif ($dtuser->role == "buyer") {
                // Mengirimkan objek pengguna ke view  
                return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'user' => $dtuser,'product' => $dt_product_login]);
            } elseif ($dtuser->role == "admin"){
                // Mengirimkan objek pengguna ke view
                return view('RegisterSeller');
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