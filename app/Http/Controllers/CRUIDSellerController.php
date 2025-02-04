<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CRUIDSellerController extends Controller
{
    public function ShowProducts(){
        $data_biji_kopi = DB::table('tblproducts')
                        ->paginate(10);
                    
        return view('CRUIDSeller',['title'=>'Coffee Been'],compact('data_biji_kopi'));
    }



    public function AddProductCoffeeBeen(Request $request){

        //Validasi data
        $validate = Validator::make($request->all(),[
            'image' => 'required|mimes:png,jpg|max:2048',
        ]);
        
        if($validate->fails()) return redirect() -> back() -> withInput() -> withErrors($validate);

        // Menyimpan data produk
        $add_coffe_been = new tblproduct();
        $add_coffe_been->nama_product = $request->nama_product;
        $add_coffe_been->image = $request->file('image');
        $add_coffe_been->jumlah_product = $request->jumlah_product;
        $add_coffe_been->price = $request->price;
        $add_coffe_been->description = $request->description;
        $add_coffe_been->product_unggulan = $request->has('produk_unggulan') ? 1 : 0; // Mengatur nilai 1 atau 0

        // Menyimpan file gambar
        //if ($request->hasFile('image')) {
        //    $imagePath = $request->file('image')->store('Product Image', 'public'); // Simpan gambar di folder public
        //    $add_coffe_been->image = $imagePath; // Simpan path gambar ke database
       //     dd($add_coffe_been->image);
        //}

        //dd($add_coffe_been);
        $add_coffe_been->save();
        

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
        //dd($product);
        // Memperbarui data produk
        $product->nama_product = $request->nama_product;
        $product->image = $request->image;
        $product->jumlah_product = $request->jumlah_product;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_unggulan = $request->has('produk_unggulan') ? 1 : 0; // Mengatur nilai 1 atau 0
        //dd($product);
        $product->save();

        $data_biji_kopi = DB::table('tblproducts')
                        ->paginate(10);

        return view('CRUIDSeller', ['title' => 'Coffee Been'], compact('data_biji_kopi'));
    }
}