<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); 
        
        if ($query) {
            $products = DB::table('tblproducts')
                          ->where('nama_product', 'like', '%' . $query . '%')
                          ->Where('category','=', 'Coffee Been')
                          ->get();
        } else {
            $products = DB::table('tblproducts')->get();
        }

        return response()->view('partials.product-list', ['products' => $products]);
    }
}