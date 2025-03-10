<?php

use App\Http\Controllers\AuthLogin;
use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegController;
use App\Http\Controllers\CRUIDSellerController;
use App\Http\Controllers\ProductShow;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\CheckoutController;



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

Route::get('/Event', function () {
    return view('Event');
});

Route::get('/ShoppingCart/{user}', [ShoppingCartController::class, 'ShowShoppingCart']);

Route::get('/add_produk/{name_seller}',[CRUIDSellerController::class,'ShowAddProduct']);

Route::get('/Logout',[AuthLogin::class,'Logout']);

Route::get('/edit_produk/{id}/{user}',[CRUIDSellerController::class,'Edit_Produk']);

Route::get('/add_stock/{id}/{user}',[CRUIDSellerController::class,'Add_Stock']);

Route::get('/Product', [ProductShow::class, 'ProductShowNotLogin']);

Route::get('/ProductMachineCoffee', [ProductShow::class, 'ProductMachineCoffeeShowNotLogin']);

Route::get('/delete_shoppingcart/{id}/{name_buyer}',[ShoppingCartController::class,'DeleteShoppingCart']);

Route::get('/CRUIDSeller/{name_seller}',[CRUIDSellerController::class,'ShowCRUIDSeller']);

Route::get('/Checkout/{user}',[CheckoutController::class,'Checkout']);



Route::post('/Register', [RegController::class, 'RegUser']);

Route::post('/RegisterSeller',[RegController::class,'RegSeller']);

Route::post('/Login',[AuthLogin::class,'AuthUser']);

Route::post('/CRUIDSeller',[CRUIDSellerController::class,'AddProductCoffeeBeen']);

Route::post('/Carousel',[CarouselController::class,'AddAds']);

Route::post('/edit_produk/{id}/{user}', [CRUIDSellerController::class, 'UpdateProductCoffeeBeen']);

Route::post('/add_stock',[CRUIDSellerController::class,'Tambah_Stock']);

Route::post('/addshoppingcart',[ShoppingCartController::class,'AddShoppingCart']);