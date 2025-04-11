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
        

        
        $data_carousel = DB::table('carousels')->get();                

        if (Auth::attempt($credentials)) {
                
            $request->session()->regenerate();
            

            $dtuser = User::where('email', $credentials['email'])->first();

            // Mengambil data biji kopi dan jumlah stock biji kopi
            $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image')
                            ->simplePaginate(3);

            $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->simplePaginate(3);
                    
            $data_carousel = DB::table('carousels')->simplePaginate(3);

            $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $dtuser->name)
                            ->where('status_transaksi', 'pending')
                            ->count();

            $data_all_product = DB::table('tblproducts as p')
                                ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                                ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                                ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                                ->simplePaginate(6); 
                                
            $carousel = DB::table('carousels')->get();                    

            if( $dtuser->role == "seller"){
                // Mengirimkan objek pengguna ke view
                return view('CRUIDSeller', ['title' => $dtuser->name, 'user' => $dtuser->name,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);
            } elseif ($dtuser->role == "buyer") {
                // Mengirimkan objek pengguna ke view  
                return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'count_shopping_cart' => $data_transaksi,'user' => $dtuser->name,'product' => $data_all_product,'Carousel' => $carousel]);
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