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
    
    public function ShowAddProduct($name_seller){
        //dd($name_seller);
        return view('ModalForm', ['title' => 'Welcome '.$name_seller, 'nama_seller' => $name_seller]);
    }

    public function AddProductCoffeeBeen(Request $request){
        
        dd($request);
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
        $add_coffe_been->save();

        // Menyimpan data produk pada table pembelian
        $add_buy_coffee_been = new tblpembelian();
        $add_buy_coffee_been->nama_product = $request->nama_product;
        $add_buy_coffee_been->jumlah_product = $request->jumlah_product;

        // Menyimpan data produk pada table stok
        $add_buy_stock = new tblstock_log();
        $add_buy_stock->nama_product = $request->nama_product;
        $add_buy_stock->jumlah_produk_beli = $request->jumlah_product;

        $data_biji_kopi = DB::table('tblproducts')
                        ->paginate(10);

        return view('CRUIDSeller', ['title' => 'Coffee Been'], compact('data_biji_kopi'));
    }

    public function edit_produk($id) {
        $edit_produk = tblproduct::find($id);
        //dd($edit_produk);                
        return view('ModalForm_EditProduk',['title' => 'Coffee Been'], compact('edit_produk'));
    }

    public function UpdateProductCoffeeBeen(Request $request, $id) {
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
        $product->jumlah_product = $request->jumlah_product;
        $product->price = $request->price;
        $product->description = $request->description;
        //dd($product);
        $product->save();

        $data_biji_kopi = DB::table('tblproducts')
                        ->paginate(10);

        return view('CRUIDSeller', ['title' => 'Coffee Been'], compact('data_biji_kopi'));
    }
}