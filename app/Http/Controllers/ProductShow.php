<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;


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
                'p.discount',
                'p.discount_price',
                'p.image',
                'p.description',
                DB::raw('COALESCE((
                    SELECT (COALESCE(SUM(jumlah_product_beli), 0) - COALESCE(SUM(jumlah_product_jual), 0))
                    FROM tblstock_logs
                    WHERE tblstock_logs.nama_product = p.nama_product
                ), 0) as stock')
            )
            ->where('p.category','=', 'Coffee Been')
            ->groupBy('p.id', 'p.nama_product', 'p.price', 'p.description', 'p.image','p.discount','p.discount_price')
            ->simplePaginate(6);

            
            
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
                'p.discount',
                'p.discount_price',
                'p.image',
                'p.description',
                DB::raw('COALESCE((
                    SELECT (COALESCE(SUM(jumlah_product_beli), 0) - COALESCE(SUM(jumlah_product_jual), 0))
                    FROM tblstock_logs
                    WHERE tblstock_logs.nama_product = p.nama_product
                ), 0) as stock')
            )
            ->where('p.category','=', 'Machine Coffee')
            ->groupBy('p.id', 'p.nama_product', 'p.price', 'p.description', 'p.image','p.discount','p.discount_price')
            ->simplePaginate(6);

            return view('ProductMachineCoffee',['title'=>'Machine Coffee'], compact('Carousel','dt_product_not_login'));
    }

    public function Order_Status_Buyer($name_buyer)
    {
        $data_user = DB::table('users')
                            ->where('name', $name_buyer)
                            ->first();
                            
        $dt_order_status = DB::table('tbltransaksis as trx')
                            ->leftJoin('tblproducts as prod', 'trx.nama_product', '=', 'prod.nama_product')
                            ->where('trx.nama_pembeli', $name_buyer)
                            ->select(
                                'trx.id',
                                'trx.order_id',
                                'trx.nama_pembeli',
                                'trx.nama_product',
                                'prod.image',
                                'trx.jumlah_product',
                                'prod.description',
                                'trx.total_price',
                                'trx.alamat_pengiriman',
                                'trx.no_HP',
                                'trx.status_transaksi',
                                'trx.AWB_Bill',
                                'trx.updated_at',
                            )
                            ->orderBy('trx.updated_at', 'desc')
                            ->simplePaginate(5);
                            

        $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $name_buyer)
                            ->where('status_transaksi', 'pending')
                            ->count();
                   
        return view('Order_Status_Buyer',['title' => 'Welcome '.$data_user->name, 'count_shopping_cart' => $data_transaksi,'user' => $data_user,'dttransaksi' => $dt_order_status]);
    }

    public function ProductShowLogin($name, $category){
        $dtuser = DB::table('users')
                            ->where('name', $name)
                            ->first();
                            

        $data_transaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $dtuser->name)
                            ->where('status_transaksi', 'pending')
                            ->count();

        if($category == 'Coffee Been'){
            $data_all_product = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.discount','p.discount_price','p.description')
                            ->where('p.category','=', 'Coffee Been')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->simplePaginate(6);
        }else if($category == 'Machine Coffee'){
            $data_all_product = DB::table('tblproducts as p')
                            ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
                            ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.discount','p.discount_price','p.description')
                            ->where('p.category','=', 'Machine Coffee')
                            ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image')
                            ->simplePaginate(6);
        }
                            
        $carousel = DB::table('carousels')->get();
        
        return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'count_shopping_cart' => $data_transaksi,'user' => $dtuser->name,'product' => $data_all_product,'Carousel' => $carousel]);
    }

}