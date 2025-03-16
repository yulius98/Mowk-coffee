<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

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
            ),
                        
        );

        $snapToken = Snap::getSnapToken($params);
        
        $transactions->update(['snap_token' => $snapToken]);
        $transactions->update(['order_id' => $params['transaction_details']['order_id']]);
    
        return view('Payment', ['title' => 'Welcome '.$user->name,'snapToken' => $snapToken,'user' => $user->name,'total_price' => $total_price,'dttransaksi' => $data_transaksi]);
    }
}