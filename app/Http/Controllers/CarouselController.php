<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarouselController extends Controller
{
    
    public function ShowAds($name_seller) {
        //dd($name_seller);
        return view('Carousel', ['title' => $name_seller, 'nama_seller' => $name_seller]);
    }
    
    public function AddAds(Request $request) {
        //dd($request);
         $add_Ads = new Carousel();
         $add_Ads->image = $request->file('image')->store('carousel-ads');
         $add_Ads->save();

         $data_carousel = DB::table('carousels')->get();
        
         // Mengambil data biji kopi dan jumlah stock biji kopi
         $data_biji_kopi = DB::table('tblproducts as p')
                         ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                         ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
                         ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                         ->paginate(10);
         
         return view('CRUIDSeller', ['title' => $request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi]);

         
    }
}