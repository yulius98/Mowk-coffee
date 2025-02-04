<?php

use App\Http\Controllers\AuthLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegController;
use App\Http\Controllers\CRUIDSellerController;
use App\Http\Controllers\ProductShow;

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

Route::get('/ModalForm', function () {
    return view('ModalForm');
});

Route::post('/Register', [RegController::class, 'RegUser']);

Route::post('/Login',[AuthLogin::class,'AuthUser']);

Route::get('/Logout',[AuthLogin::class,'Logout']);

Route::get('/CRUIDSeller',[CRUIDSellerController::class,'ShowProducts']);

Route::post('/CRUIDSeller',[CRUIDSellerController::class,'AddProductCoffeeBeen']);

Route::get('/edit_produk/{id}',[CRUIDSellerController::class,'Edit_Produk']);

Route::post('/edit_produk/{id}', [CRUIDSellerController::class, 'UpdateProductCoffeeBeen']);

Route::get('/Product', [ProductShow::class, 'ProductShowNotLogin']);

//Route::get('/ProductLogin',[ProductShow::class,'ProductShowLogin'] );