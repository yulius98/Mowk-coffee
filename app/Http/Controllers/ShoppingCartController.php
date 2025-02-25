<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\tblpenjualan;
use App\Models\tblstock_log;
use App\Models\tbltransaksi;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function getPendingTransactionsCount($username)
    {
        return tbltransaksi::where('nama_pembeli', $username)
                          ->where('status_transaksi', 'pending')
                          ->count();
    }

    
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

        $data_user = DB::table('users')
                        ->where('name', $request->nama_pembeli)
                        ->first();

        // Menyimpan data transaksi pada table transaksi                
        $add_data_transaksi = new tbltransaksi();
        $add_data_transaksi->nama_pembeli = $request->nama_pembeli;
        $add_data_transaksi->nama_product = $request->nama_product;
        $add_data_transaksi->jumlah_product = $request->jumlah_product;
        $add_data_transaksi->total_price = $request->total_price;
        $add_data_transaksi->alamat_pengiriman = $data_user->alamat_pengiriman;
        $add_data_transaksi->no_HP = $data_user->no_HP;
        $add_data_transaksi->status_transaksi = 'pending';
        $add_data_transaksi->save();



        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->groupBy('p.id','p.nama_product','p.price','p.description', 'p.image')
                            ->paginate(10);

        $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $request->nama_pembeli)
                            ->where('status_transaksi', 'pending')
                            ->count();

        
        

        
        return view('ProductLogin', ['title' => 'Welcome '.$request->nama_pembeli, 'user' => $request->nama_pembeli,'product' => $data_biji_kopi,'count_shopping_cart' => $data_transaksi]);    
     }


        public function ShowShoppingCart($username)
        {
            
            $data_user = DB::table('users')
                            ->where('username', $username)
                            ->first();
            $data_transaksi = DB::table('tbltransaksis as trx')
                            ->leftJoin('tblproducts as prod', 'trx.nama_product', '=', 'prod.nama_product')
                            ->where('trx.nama_pembeli', $username)
                            ->where('trx.status_transaksi', 'pending')
                            ->select(
                                'trx.id',
                                'trx.nama_pembeli',
                                'trx.nama_product',
                                'prod.image',
                                'trx.jumlah_product',
                                'prod.description',
                                'trx.total_price',
                                'trx.alamat_pengiriman',
                                'trx.no_HP',
                                'trx.status_transaksi'
                            )
                            ->orderBy('trx.id', 'desc')
                            ->get();
            
            $total_price = DB::table('tbltransaksis as trx')
                            ->where('nama_pembeli', $username)
                            ->where('status_transaksi', 'pending')
                            ->sum('total_price');                    

            return view('Shopping_Cart', ['title' => 'Welcome '.$data_user->name, 'user' => $data_user,'dttransaksi' => $data_transaksi, 'total_price' => $total_price]);    
        }

        public function DeleteShoppingCart($id,$name_buyer)
        {
            
            $Get_dt_transaksi = DB::table('tbltransaksis')
                            ->where('id', $id)
                            ->first();

            $delete_stock = DB::table('tblstock_logs')
                            ->where('nama_product', $Get_dt_transaksi->nama_product)
                            ->where('jumlah_product_jual', $Get_dt_transaksi->jumlah_product)
                            ->delete();
            
            $delete_tblpenjualan = DB::table('tblpenjualans')
                                ->where('nama_pembeli','=',$Get_dt_transaksi->nama_pembeli)
                                ->where('nama_product','=',$Get_dt_transaksi->nama_product)
                                ->where('jumlah_product','=',$Get_dt_transaksi->jumlah_product)
                                ->delete();
            
            $delete_transaksi = DB::table('tbltransaksis')
                                ->where('id', $id)
                                ->delete();

            $data_user = DB::table('users')
                            ->where('username', $name_buyer)
                            ->first();

            $data_transaksi = DB::table('tbltransaksis as trx')
                            ->leftJoin('tblproducts as prod', 'trx.nama_product', '=', 'prod.nama_product')
                            ->where('trx.nama_pembeli', $name_buyer)
                            ->where('trx.status_transaksi', 'pending')
                            ->select(
                                'trx.id',
                                'trx.nama_pembeli',
                                'trx.nama_product',
                                'prod.image',
                                'trx.jumlah_product',
                                'prod.description',
                                'trx.total_price',
                                'trx.alamat_pengiriman',
                                'trx.no_HP',
                                'trx.status_transaksi'
                            )
                            ->orderBy('trx.id', 'desc')
                            ->get();

            $total_price = DB::table('tbltransaksis as trx')
                            ->where('nama_pembeli', $name_buyer)
                            ->where('status_transaksi', 'pending')
                            ->sum('total_price');

            return view('Shopping_Cart', ['title' => 'Welcome '.$data_user->name, 'user' => $data_user,'dttransaksi' => $data_transaksi, 'total_price' => $total_price]);
        }
}