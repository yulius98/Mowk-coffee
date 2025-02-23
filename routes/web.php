<?php

use App\Http\Controllers\AuthLogin;
use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegController;
use App\Http\Controllers\CRUIDSellerController;
use App\Http\Controllers\ProductShow;
use App\Http\Controllers\ShoppingCartController;



Route::get('/', function () {
    return view('home');
});


Route::get('/About', function () {
    return view('About');
});

Route::get('/Login', function () {
    return view('Login');
});

Route::get('/Register', function () {
    return view('Register');
});

Route::get('/RegisterSeller', function () {
    return view('RegisterSeller');
});

Route::get('/ShoppingCart/{user}', [ShoppingCartController::class, 'ShowShoppingCart']);

Route::get('/add_produk/{name_seller}',[CRUIDSellerController::class,'ShowAddProduct']);

Route::get('/Logout',[AuthLogin::class,'Logout']);

Route::get('/edit_produk/{id}/{user}',[CRUIDSellerController::class,'Edit_Produk']);

Route::get('/Product', [ProductShow::class, 'ProductShowNotLogin']);

Route::get('/delete_shoppingcart/{id}/{name_buyer}',[ShoppingCartController::class,'DeleteShoppingCart']);





Route::post('/Register', [RegController::class, 'RegUser']);

Route::post('/RegisterSeller',[RegController::class,'RegSeller']);

Route::post('/Login',[AuthLogin::class,'AuthUser']);

Route::post('/CRUIDSeller',[CRUIDSellerController::class,'AddProductCoffeeBeen']);

Route::post('/Carousel',[CarouselController::class,'AddAds']);

Route::post('/edit_produk/{id}/{user}', [CRUIDSellerController::class, 'UpdateProductCoffeeBeen']);

Route::post('/addshoppingcart',[ShoppingCartController::class,'AddShoppingCart']);