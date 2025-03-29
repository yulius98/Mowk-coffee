<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function EditProfile(Request $request){
        $edit_profile = User::where('username',$request->username)->first();
        $edit_profile->name = $request->name;
        $edit_profile->username = $request->username;
        $edit_profile->password = $request->password;
        $edit_profile->email = $request->email;
        $edit_profile->alamat_pengiriman = $request->alamat_pengiriman;
        $edit_profile->no_HP = $request->no_HP;
        $edit_profile->save();

        $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $edit_profile->name)
                            ->where('status_transaksi', 'pending')
                            ->count();

        $data_all_product = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->get();                     

        return view('ProductLogin', ['title' => 'Welcome '.$edit_profile->name, 'count_shopping_cart' => $data_transaksi,'user' => $edit_profile->name,'product' => $data_all_product]);
        
    }

    public function Show_Edit_Profile($user){
        $data_user = User::where('name',$user)->first();

        $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $data_user->name)
                            ->where('status_transaksi', 'pending')
                            ->count();

        $data_all_product = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->get();  
        
                           
        return view('Edit_Profile', ['title' => 'Welcome '.$data_user->name, 'count_shopping_cart' => $data_transaksi,'user' => $data_user,'product' => $data_all_product]);
    }


}