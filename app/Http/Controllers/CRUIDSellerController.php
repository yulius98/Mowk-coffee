<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use App\Models\tblpembelian;
use App\Models\tblstock_log;
use App\Models\tbltransaksi;
use App\Models\Carousel;
use App\Models\tblevent;
use App\Models\tblpesertaEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CRUIDSellerController extends Controller
{
    
    public function ShowCRUIDSeller($name_seller){
        //dd($name_seller);
        //$data_carousel = DB::table('carousels')->simplePaginate(3);
        $data_carousel = Carousel::simplePaginate(3);
        
        // Mengambil data biji dan mesin kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
                            ->simplePaginate(3);
        //dd($data_mesin_kopi);    
        
        return view('CRUIDSeller', ['title' => $name_seller, 'user' => $name_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);
                                        
    }


    public function ShowAddProduct($name_seller,$category){
        //dd($category);
        return view('ModalForm', ['title' => $name_seller, 'nama_seller' => $name_seller, 'category' => $category]);
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

        $validator_product = DB::table('tblproducts')
                            ->where('nama_product', '=',$request->nama_product)
                            ->get();

        if ($validator_product->count() > 0) {
            return redirect()->back()->withInput()->withErrors('Product already exist');
        }
        // Menyimpan data produk pada table produk
        $add_coffe_been = new tblproduct();
        $add_coffe_been->nama_product = $request->nama_product;
        $add_coffe_been->image = $request->file('image')->store('product-images');
        $add_coffe_been->description = $request->description;
        $add_coffe_been->price = $request->price;
        $add_coffe_been->discount = $request->discount;
        $add_coffe_been->discount_price = $request->discount_price;
        
        if ($request->jenis_product == 'Coffee Been') {
            $add_coffe_been->category = 'Coffee Been';
        }
        if ($request->jenis_product == 'Machine Coffee') {
            $add_coffe_been->category = 'Machine Coffee';
        }
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

        
        $data_carousel = DB::table('carousels')->simplePaginate(3);
        
        // Mengambil data biji kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
                            ->simplePaginate(3);
                                        
        return view('CRUIDSeller', ['title' => $request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi , 'data_mesin_kopi' => $data_mesin_kopi]);

        
    }

    public function edit_produk($id,$user) {
        $edit_produk = DB::table('tblproducts')
                    ->where('id', $id)
                    ->first();
           
        return view('ModalForm_EditProduk', ['title' => $user, 'edit_produk' =>$edit_produk,'user' => $user]);             
        
    }

    public function add_stock($id,$user) {
        $edit_produk = tblproduct::find($id);
        //dd($user);   
        return view('ModalForm_AddStock', ['title' => $user, 'edit_produk' =>$edit_produk,'user' => $user]);             
        
    }

    public function Tambah_Stock(Request $request) {
        //dd($request);

        // Menambahkan stock pada table stok
        $add_stock = new tblstock_log();
        $add_stock->nama_product = $request->nama_product;
        $add_stock->jumlah_product_beli = $request->stock;
        $add_stock->jumlah_product_jual = 0;
        $add_stock->save();

        // Menyimpan data produk pada table pembelian
        $add_pembelian = new tblpembelian();
        $add_pembelian->nama_seller = $request->user;
        $add_pembelian->nama_product = $request->nama_product;
        $add_pembelian->jumlah_product = $request->stock;
        $add_pembelian->save();

        $data_carousel = DB::table('carousels')->simplePaginate(3);
        
        // Mengambil data biji kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
                            ->simplePaginate(3);

        return view('CRUIDSeller', ['title' => $request->user, 'user' => $request->user,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi,'data_mesin_kopi' => $data_mesin_kopi]);                
    }

    
    public function UpdateProductCoffeeBeen(Request $request, $id,$user) {
        // Mengambil produk berdasarkan ID  
        
        $product = DB::table('tblproducts')
                    ->where('id', $id)
                    ->first();

        //dd($product);
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048' // Validasi file gambar
        ]);

        // Menangani kesalahan jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $file = storage_path('app/public/'. $product->image);
        if (file_exists($file)) {
            unlink($file);
        }

        // Memperbarui data produk
        DB::table('tblproducts')
            ->where('id', $id)
            ->update([
                'nama_product' => $request->nama_product,
                'image' => $request->file('image')->store('product-images'),
                'price' => $request->price,
                'discount' => $request->discount,
                'discount_price' => $request->discount_price,
                'description' => $request->description
            ]);

        
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
                            ->simplePaginate(3);

        $data_carousel = DB::table('carousels')->simplePaginate(3);

        return view('CRUIDSeller', ['title' => $user, 'user' => $user,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi,'data_mesin_kopi' => $data_mesin_kopi]);
        
    }


    public function Show_Order_Shipping_Product($user){
        $data_shipping_product = DB::table('tbltransaksis')
                                    ->where('status_transaksi','=','paid')
                                    ->orderByDesc('order_id')
                                    ->get();

        $all_status_order_product = DB::table('tbltransaksis')
                                    ->orderByDesc('nama_pembeli')
                                    ->get();

        return view ('Dashboard_Order_Product',['title' => $user,'data_shipping' => $data_shipping_product,'all_status_order' => $all_status_order_product]);
    }

    public function Shipping_Product ($id, $title){
        $dt_shipping = tbltransaksi::find($id);
        //dd($dt_shipping);                

        return view('Add_Shipping_Product',['title'=>$title,'dt_shipping'=>$dt_shipping, 'dttitle' =>$title]);
    }

    public function Add_AWB_Bill(request $request,$user){
        //dd($request);

        //dd($user);
        $AWB_Bill = tbltransaksi::find($request->id);
        //dd($AWB_Bill);

        $AWB_Bill->update([
            'status_transaksi' => 'send',
            'AWB_Bill' => $request->no_awb,
            
        ]);
        

        $data_shipping_product = DB::table('tbltransaksis')
                                    ->where('status_transaksi','=','paid')
                                    ->orderByDesc('order_id')
                                    ->get();

        $all_status_order_product = DB::table('tbltransaksis')
                                    ->orderByDesc('nama_pembeli')
                                    ->get();

        return view ('Dashboard_Order_Product',['title' => $user,'data_shipping' => $data_shipping_product,'all_status_order' => $all_status_order_product]);
        
    }

    public function Delete_Produk($id,$user){
        // Menghapus produk berdasarkan ID
        //dd($id);
        $product = DB::table('tblproducts')
                    ->where('id', $id)
                    ->first();
        //dd($product);
        $file = storage_path('app/public/'. $product->image);
        if (file_exists($file)) {
            unlink($file);
        }
        DB::table('tblproducts')->where('id', $id)->delete();
        

        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->orderByDesc('p.updated_at')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
                            ->simplePaginate(3);

        $data_carousel = DB::table('carousels')->simplePaginate(3);

        return view('CRUIDSeller', ['title' => $user, 'user' => $user,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi,'data_mesin_kopi' => $data_mesin_kopi]);
    }

    public function Show_Event($user){
        
        $data_event = tblevent::orderByDesc('id')->get();
        $data_peserta_event = tblpesertaEvent::orderByDesc('name_event')
                            ->orderByDesc('nama_peserta')
                            ->get();
        
        
        return view ('Dashboard_Event',['title' => $user,'data_event' => $data_event,'data_peserta_event' => $data_peserta_event]);
    }
    public function Add_Event($user){
        return view ('ModalForm_AddEvent',['title' => $user]);
    }
    public function Edit_Event($id,$user){
        $edit_event = DB::table('tblevent')
                    ->where('id', $id)
                    ->first();
        //dd($edit_event);
        return view ('ModalForm_EditEvent',['title' => $user,'edit_event' => $edit_event]);
    }

}