<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarouselController extends Controller
{
        public function AddAds(Request $request) {
    
         $add_Ads = new Carousel();
         $add_Ads->image = $request->file('image')->store('carousel-ads');
         $add_Ads->save();

         return view('home');
    }
}