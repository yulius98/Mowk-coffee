<?php

namespace App\Http\Controllers;

use App\Models\tblproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductShow extends Controller
{
    public function ProductShowNotLogin() 
    {
            $dt_product_not_login = DB::table('tblproducts')
                                    -> paginate(10);
            

            //dd($dt_product_not_login);                        
            return view('Product',['title'=>'Coffee Been'], compact('dt_product_not_login'));

    }

    public function ProductShowLogin() 
    {
        $dt_product_login = DB::table('tblproducts')
        ->paginate(10);

        //dd($dt_product_login);
        return view('ProductLogin',['title' => 'Coffe Been'],compact('dt_product_login'));
    }
}