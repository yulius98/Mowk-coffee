<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function Checkout($transaction){
        return view('Checkout',['transaction'=>$transaction]);
    }
}