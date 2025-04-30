<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\tblproduct;
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
         
        return redirect('/CRUIDSeller/'.$request->nama_seller)->with('success', 'Ads added successfully!');
        //return view('CRUIDSeller', ['title' => $request->nama_seller, 'user' => $request->nama_seller,'data_carousel' => $data_carousel ,'data_biji_kopi' => $data_biji_kopi ,'data_mesin_kopi' => $data_mesin_kopi]);

         
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

        return redirect('/CRUIDSeller/'.$seller)->with('success', 'Ads updated successfully!');
                            
    }

    public function DeleteAds($seller,$id) {
        
        Carousel::destroy($id);
        
        $delete_Ads = DB::table('carousels')
                    ->where('id', $id)
                    ->first();
        
        $file = storage_path('app/public/'. $delete_Ads->image);
        
        if (file_exists($file)) {
            unlink($file);
        } 

              
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

        
        return redirect('/CRUIDSeller/'.$seller)->with('success', 'Ads deleted successfully!');
        
    }
}