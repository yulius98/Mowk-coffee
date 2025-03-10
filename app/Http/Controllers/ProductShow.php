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
            ->select(
                'p.id',
                'p.nama_product',
                'p.price',
                'p.image',
                'p.description',
                DB::raw('COALESCE((
                    SELECT (COALESCE(SUM(jumlah_product_beli), 0) - COALESCE(SUM(jumlah_product_jual), 0))
                    FROM tblstock_logs
                    WHERE tblstock_logs.nama_product = p.nama_product
                ), 0) as stock')
            )
            ->where('p.category','=', 'Coffee Been')
            ->groupBy('p.id', 'p.nama_product', 'p.price', 'p.description', 'p.image')
            ->paginate(10);

            
            
            return view('Product',['title'=>'Coffee Been'], compact('Carousel','dt_product_not_login'));
    }

    public function ProductMachineCoffeeShowNotLogin() 
    {
            
            $Carousel = DB::table('carousels')
                    ->get();

            $dt_product_not_login = DB::table('tblproducts as p')
            ->select(
                'p.id',
                'p.nama_product',
                'p.price',
                'p.image',
                'p.description',
                DB::raw('COALESCE((
                    SELECT (COALESCE(SUM(jumlah_product_beli), 0) - COALESCE(SUM(jumlah_product_jual), 0))
                    FROM tblstock_logs
                    WHERE tblstock_logs.nama_product = p.nama_product
                ), 0) as stock')
            )
            ->where('p.category','=', 'Machine Coffee')
            ->groupBy('p.id', 'p.nama_product', 'p.price', 'p.description', 'p.image')
            ->paginate(10);

            
            
            return view('ProductMachineCoffee',['title'=>'Machine Coffee'], compact('Carousel','dt_product_not_login'));
    }
}