<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Carousel;
use App\Models\tblproduct;
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
        

        if (Auth::attempt($credentials)) {
                
            $request->session()->regenerate();
            

            $dtuser = User::where('email', $credentials['email'])->first();

            // Mengambil data biji kopi dan jumlah stock biji kopi
            $data_carousel = Carousel::simplePaginate(3);
            
            $data_biji_kopi = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                 ->select( 'tblproducts.id','tblproducts.nama_product','tblproducts.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                 ->where('tblproducts.category','=','Coffee Been')
                                 ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                 ->simplePaginate(3);
            $data_mesin_kopi = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                 ->select( 'tblproducts.id','tblproducts.nama_product','tblproducts.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                 ->where('tblproducts.category','=','Machine Coffee')
                                 ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price','tblproducts.description', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price')
                                 ->simplePaginate(3);

            $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $dtuser->name)
                            ->where('status_transaksi', 'pending')
                            ->count();

            $data_all_product = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                ->select( 'tblproducts.id','tblproducts.nama_product','tblproducts.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                ->simplePaginate(6);
            //dd($data_all_product);                    
            $carousel = Carousel::all();                    

            if( $dtuser->role == "seller"){
                // Mengirimkan objek pengguna ke view
                return redirect('/CRUIDSeller/'.$dtuser->name);
                
                //return view('CRUIDSeller', ['title' => $dtuser->name, 'user' => $dtuser->name,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);
            } elseif ($dtuser->role == "buyer") {
                // Mengirimkan objek pengguna ke view  
                return redirect('/ProductLogin/'.$dtuser->name.'/Coffee Been');
                //return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'count_shopping_cart' => $data_transaksi,'user' => $dtuser->name,'product' => $data_all_product,'Carousel' => $carousel]);
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