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

    public function Edit_Ads($user,$id) {
        
        
        $edit_Ads = DB::table('carousels')
                    ->where('id', $id)
                    ->get();
        
        //dd($edit_Ads);  
        return view('Edit_Carousel', ['title' => $user, 'nama_seller' => $user, 'edit_Ads' => $edit_Ads]);
        
    }
    
    public function AddAds(Request $request) {
        //dd($request);
         $add_Ads = new Carousel();
         $add_Ads->image = $request->file('image')->store('carousel-ads');
         $add_Ads->save();

         $data_carousel = DB::table('carousels')->simplePaginate(3);
        
         // Mengambil data biji kopi dan jumlah stock biji kopi
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->simplePaginate(3);
         
        return view('CRUIDSeller', ['title' => $request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);

         
    }

    public function UpdateAds(Request $request, $seller) {
        
        //dd($request);
        $update = DB::table('carousels')
                        ->where('image', $request->old_image)
                        ->first();

        $file = storage_path('app/public/'. $update->image);
        
        if (file_exists($file)) {
            unlink($file);
            

        } 
        $update = Carousel::where('image', $request->old_image)
                        ->update(['image' => $request->file('image')->store('carousel-ads')]);  
                        
                        
        $data_carousel = DB::table('carousels')->simplePaginate(3);
        $data_biji_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Coffee Been')
                            ->groupBy('p.id','p.nama_product', 'p.price', 'p.image')
                            ->simplePaginate(3);

        $data_mesin_kopi = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
                            ->where('p.category','=','Machine Coffee')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->simplePaginate(3);

        return view('CRUIDSeller', ['title' => $request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);
    }

    public function DeleteAds($seller,$id) {
        $delete_Ads = Carousel::find($id);
        //dd($delete_Ads);
        $file = storage_path('app/public/'. $delete_Ads->image);
        
        if (file_exists($file)) {
            unlink($file);
        } 

        $delete_Ads->delete();
        return redirect()->back();
    }
}