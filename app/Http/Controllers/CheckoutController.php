<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccess;
use App\Models\tblproduct;

class CheckoutController extends Controller
{
    public function Checkout($username, $total_price){
    
            $user = DB::table('users')
                    ->where('name', $username)
                    ->first();

            $data_transaksi = DB::table('tbltransaksis as trx')
                    ->leftJoin('tblproducts as prod', 'trx.nama_product', '=', 'prod.nama_product')
                    ->where('trx.nama_pembeli', $username)
                    ->where('trx.status_transaksi', 'pending')
                    ->select(
                        'trx.id',
                        'trx.nama_pembeli',
                        'trx.nama_product',
                        'prod.image',
                        'trx.jumlah_product',
                        'prod.description',
                        'trx.total_price',
                        'trx.alamat_pengiriman',
                        'trx.no_HP',
                        'trx.status_transaksi'
                    )
                    ->orderBy('trx.id', 'desc')
                    ->get();
                    
            $transactions = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $username)
                            ->where('status_transaksi', 'pending');

            $Jstransaksi = DB::table('tbltransaksis')
                            ->where('nama_pembeli', $username)
                            ->where('status_transaksi', 'pending')
                            ->get();
                            
            $MapJstransaksi = $Jstransaksi->map(function ($item) {
                return [
                    'id' => rand(),
                    'name' => $item->nama_product,
                    'price' => $item->total_price / $item->jumlah_product, 
                    'quantity' => $item->jumlah_product,
                    
                ];
            });                
            //dd($MapJstransaksi);
        //SAMPLE REQUEST START HERE

        // Set Midtrans configuration from config file
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds = config('midtrans.is_3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_price,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->no_HP,
                'address'=> $user->alamat_pengiriman,
                
            ),
            'item_details' => $MapJstransaksi->toArray() ,
                        
        );
        

        $snapToken = Snap::getSnapToken($params);
        
        $transactions->update(['snap_token' => $snapToken]);
        $transactions->update(['order_id' => $params['transaction_details']['order_id']]);
    
        return view('Payment', ['title' => 'Welcome '.$user->name,'snapToken' => $snapToken,'user' => $user->name,'total_price' => $total_price,'dttransaksi' => $data_transaksi]);
    }

    public function Success($username){
        
        $user = DB::table('users')
                    ->where('name', $username)
                    ->first();

        
                
        $transactions = DB::table('tbltransaksis')
                        ->where('nama_pembeli', $username)
                        ->where('status_transaksi', 'pending');

        $dttrasaction = $transactions->get();

        $transactions->update(['status_transaksi' => 'paid']);
        
        $data_all_product = tblproduct::leftJoin('tblstock_logs as sl', 'tblproducts.nama_product', '=', 'sl.nama_product')
                                ->select( 'tblproducts.id','tblproducts.nama_product','tblproducts.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'tblproducts.price','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                ->groupBy('tblproducts.id','tblproducts.nama_product', 'tblproducts.price', 'tblproducts.image','tblproducts.discount','tblproducts.discount_price','tblproducts.description')
                                ->havingRaw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) <= 1')
                                ->get();
         
        
        Mail::to('wi2t.teduh@gmail.com')->send(new PaymentSuccess($user, $dttrasaction,$data_all_product));
        //Mail::to('yulius.wijaya98@gmail.com')->send(new PaymentSuccess($user, $dttrasaction,$data_all_product));

        //$data_biji_kopi = DB::table('tblproducts as p')
        //                    ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
        //                    ->select( 'p.id','p.nama_product','p.image', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.discount','p.discount_price','p.description')
        //                    ->where('p.category','=','Coffee Been')
        //                    ->groupBy('p.id','p.nama_product', 'p.price', 'p.image','p.discount','p.discount_price','p.description')
        //                    ->simplePaginate(3);
//
        //$data_all_product = DB::table('tblproducts as p')
        //                        ->leftJoin('tblstock_logs as sl', 'p.nama_product', '=', 'sl.nama_product')
        //                        ->select( 'p.id','p.nama_product', DB::raw('(COALESCE(SUM(sl.jumlah_product_beli), 0) - COALESCE(SUM(sl.jumlah_product_jual), 0)) AS stock'),'p.price','p.image','p.discount','p.discount_price','p.description')
        //                        ->groupBy('p.id','p.nama_product', 'p.price','p.description', 'p.image','p.discount','p.discount_price')
        //                        ->simplePaginate(6);
//
        //$data_transaksi = DB::table('tbltransaksis')
        //                    ->where('nama_pembeli', $username)
        //                    ->where('status_transaksi', 'pending')
        //                    ->count();
//
        //$carousel = DB::table('carousels')->get(); 
        
        return redirect('/ProductLogin/'.$username.'/Coffee Been');
        //return view('ProductLogin', ['title' => 'Welcome '.$username, 'count_shopping_cart' => $data_transaksi,'user' => $user->name,'product' => $data_all_product,'Carousel' => $carousel]);

        
    }
}