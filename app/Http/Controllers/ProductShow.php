<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;


class ProductShow extends Controller
{
    public function ProductShowNotLogin() 
    {
            
           
            $Carousel = Carousel::all();

            $dt_product_not_login = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                ->select( 
                                    'tblproducts.id',
                                    'tblproducts.nama_product', 
                                    DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),
                                    'tblproducts.price',
                                    'tblproducts.image',
                                    'tblproducts.discount',
                                    'tblproducts.discount_price',
                                    'tblproducts.description')
                                ->where('tblproducts.category','=', 'Coffee Been')
                                ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price','tblproducts.description', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price')
                                ->havingRaw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) > 0')
                                ->simplePaginate(6);
            
        
            return view('Product',['title'=>'Coffee Been'], compact('Carousel','dt_product_not_login'));
    }

    public function ProductMachineCoffeeShowNotLogin() 
    {
            
            $Carousel = Carousel::all();

            $dt_product_not_login = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                ->select( 
                                    'tblproducts.id',
                                    'tblproducts.nama_product', 
                                    DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),
                                    'tblproducts.price',
                                    'tblproducts.image',
                                    'tblproducts.discount',
                                    'tblproducts.discount_price',
                                    'tblproducts.description')
                                ->where('tblproducts.category','=', 'Machine Coffee')
                                ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price','tblproducts.description', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price')
                                ->havingRaw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) > 0')
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
            $data_all_product = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                            ->select( 'tblproducts.id','tblproducts.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.image','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                            ->where('tblproducts.category','=', 'Coffee Been')
                            ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price','tblproducts.description', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price')
                            ->havingRaw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) > 0')
                            ->simplePaginate(6);
            
        }else if($category == 'Machine Coffee'){
            $data_all_product = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                            ->select( 'tblproducts.id','tblproducts.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.image','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                            ->where('tblproducts.category','=', 'Machine Coffee')
                            ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price','tblproducts.description', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price')
                            ->havingRaw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) > 0')
                            ->simplePaginate(6);
            
            
        }
                            
        $carousel = Carousel::all();
        
        return view('ProductLogin', ['title' => 'Welcome '.$dtuser->name, 'count_shopping_cart' => $data_transaksi,'user' => $dtuser->name,'product' => $data_all_product,'Carousel' => $carousel]);
    }

}