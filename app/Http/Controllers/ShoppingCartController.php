<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\tblpenjualan;
use App\Models\tblstock_log;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function AddShoppingCart(Request $request){
        //dd($request);

        // Menyimpan data produk pada table penjualan
        $add_sell_coffee_been = new tblpenjualan();
        $add_sell_coffee_been->nama_pembeli = $request->nama_pembeli;
        $add_sell_coffee_been->nama_product = $request->nama_product;
        $add_sell_coffee_been->jumlah_product = $request->jumlah_product;
        $add_sell_coffee_been->total_price = $request->total_price;
        $add_sell_coffee_been->save();

        // Menyimpan data produk pada table stok
        $add_sell_stock = new tblstock_log();
        $add_sell_stock->nama_product = $request->nama_product;
        $add_sell_stock->jumlah_product_beli = 0;
        $add_sell_stock->jumlah_product_jual = $request->jumlah_product;
        $add_sell_stock->save();

        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->paginate(10);
        
        return view('ProductLogin', ['title' => 'Welcome '.$request->nama_pembeli, 'user' => $request->nama_pembeli,'product' => $data_biji_kopi]);    
     }
}