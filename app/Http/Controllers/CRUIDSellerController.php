<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use App\Models\tblpembelian;
use App\Models\tblstock_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CRUIDSellerController extends Controller
{
    
    public function ShowCRUIDSeller($name_seller){
        //dd($name_seller);
        $data_carousel = DB::table('carousels')->get();
        
        // Mengambil data biji kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                        ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                        ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                        ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                        ->paginate(10);
        
        return view('CRUIDSeller', ['title' => 'Welcome '.$name_seller, 'user' => $name_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi]);
                                        
    }


    public function ShowAddProduct($name_seller){
        //dd($name_seller);
        return view('ModalForm', ['title' => 'Welcome '.$name_seller, 'nama_seller' => $name_seller]);
    }

    public function AddProductCoffeeBeen(Request $request){
        
        //dd($request);
        // Validasi data
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048' // Validasi file gambar
        ]);

        // Menangani kesalahan jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // Menyimpan data produk pada table produk
        $add_coffe_been = new tblproduct();
        $add_coffe_been->nama_product = $request->nama_product;
        $add_coffe_been->image = $request->file('image')->store('product-images');
        $add_coffe_been->description = $request->description;
        $add_coffe_been->price = $request->price;
        $add_coffe_been->save();

        // Menyimpan data produk pada table pembelian
        $add_buy_coffee_been = new tblpembelian();
        $add_buy_coffee_been->nama_seller = $request->nama_seller;
        $add_buy_coffee_been->nama_product = $request->nama_product;
        $add_buy_coffee_been->jumlah_product = $request->jumlah_product;
        $add_buy_coffee_been->save();

        // Menyimpan data produk pada table stok
        $add_buy_stock = new tblstock_log();
        $add_buy_stock->nama_product = $request->nama_product;
        $add_buy_stock->jumlah_product_beli = $request->jumlah_product;
        $add_buy_stock->jumlah_product_jual = 0;
        $add_buy_stock->save();

        
        $data_carousel = DB::table('carousels')->get();
        
        // Mengambil data biji kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                        ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                        ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                        ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                        ->paginate(10);
                                        
        return view('CRUIDSeller', ['title' => 'Welcome '.$request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi]);

        
    }

    public function edit_produk($id,$user) {
        $edit_produk = tblproduct::find($id);
        //dd($user);   
        return view('ModalForm_EditProduk', ['title' => 'Welcome '.$user, 'edit_produk' =>$edit_produk,'user' => $user]);             
        
    }

    public function UpdateProductCoffeeBeen(Request $request, $id,$user) {
        // Mengambil produk berdasarkan ID  
        

        $product = tblproduct::find($id);
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048' // Validasi file gambar
        ]);

        // Menangani kesalahan jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // Memperbarui data produk
        $product->nama_product = $request->nama_product;
        $product->image = $request->file('image')->store('product-images');
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->paginate(10);

        $data_carousel = DB::table('carousels')->get();

        return view('CRUIDSeller', ['title' => 'Welcome '.$user, 'user' => $user,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi]);
        
    }
}