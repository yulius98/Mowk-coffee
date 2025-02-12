<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductShow extends Controller
{
    public function ProductShowNotLogin() 
    {
            
            $Carousel = DB::table('carousels')
                    ->get();

            $dt_product_not_login = DB::table('tblproducts as p')
            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.description')
            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
            ->paginate(10);
            
            
                                    
            return view('Product',['title'=>'Coffee Been'], compact('Carousel','dt_product_not_login'));

    }

    
}