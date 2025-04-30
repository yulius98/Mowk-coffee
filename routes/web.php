<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthLogin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProductShow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CRUIDSellerController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\EventController;


Route::get('/', function () {
    return view('home');
});

Route::get('/About', function () {
    return view('About');
});

Route::get('/Login', function () {
    return view('Login');
})->name('login');

Route::get('/Register', function () {
    return view('Register');
});

Route::get('/RegisterSeller', function () {
    return view('RegisterSeller');
});

Route::get('/Logout',[AuthLogin::class,'Logout']);

Route::get('/Event',[EventController::class,'ShowEvent'])->name('Event');

//Route untuk ShoppingCartController
Route::get('/ShoppingCart/{user}', [ShoppingCartController::class, 'ShowShoppingCart']);
Route::get('/delete_shoppingcart/{id}/{name_buyer}',[ShoppingCartController::class,'DeleteShoppingCart']);

//Route untuk CRUIDSellerController
Route::get('/add_produk/{name_seller}/{category}',[CRUIDSellerController::class,'ShowAddProduct']);
Route::get('/edit_produk/{id}/{user}',[CRUIDSellerController::class,'Edit_Produk']);
Route::get('/delete_produk/{id}/{user}',[CRUIDSellerController::class,'Delete_Produk']);
Route::get('/add_stock/{id}/{user}',[CRUIDSellerController::class,'Add_Stock']);
Route::get('/CRUIDSeller/{name_seller}',[CRUIDSellerController::class,'ShowCRUIDSeller']);
Route::get('/Carousel/{user}',[CarouselController::class,'ShowAds']);
Route::get('/Carousel/{user}/{id}',[CarouselController::class,'Edit_Ads']);
Route::delete('/Carousel_delete/{user}/{id}',[CarouselController::class,'DeleteAds']);
Route::get('/Dashboard_Order_Product/{user}',[CRUIDSellerController::class,'Show_Order_Shipping_Product']);
Route::get('/Dashboard_Event/{user}',[CRUIDSellerController::class,'Show_Event'])->name('dashboard_event');
Route::get('/shipping_product/{id}/{title}',[CRUIDSellerController::class,'Shipping_Product']);
Route::get('/add_event/{user}',[CRUIDSellerController::class,'Add_Event']);
Route::get('/edit_even/{id}/{user}',[CRUIDSellerController::class,'Edit_Event']);
Route::get('/delete_even/{id}/{user}',[CRUIDSellerController::class,'Delete_Event']);



//Route untuk ProductShow
Route::get('/Product', [ProductShow::class, 'ProductShowNotLogin']);
Route::get('/ProductMachineCoffee', [ProductShow::class, 'ProductMachineCoffeeShowNotLogin']);
Route::get('/Order_Status/{user}',[ProductShow::class,'Order_Status_Buyer']);
Route::get('ProductLogin/{name}/{category}', [ProductShow::class, 'ProductShowLogin']);


//Route untuk Checkout
Route::get('/Checkout/{user}/{total_price}',[CheckoutController::class,'Checkout']);
Route::get('/success/{user}',[CheckoutController::class,'Success']);




Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/Edit_Profile/{user}', [RegController::class, 'Show_Edit_Profile']);

Route::get('/Detail_Event/{id}',[EventController::class,'Detail_Event']);

Route::get('/Joint_Event/{id}',[EventController::class,'Joint_Event']);

// Payment success page
Route::get('/payment-success', function () {
    return redirect('/Product')->with('success', 'Payment completed successfully!');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');


// Midtrans payment notification handler
Route::post('/payment/notification', [CheckoutController::class, 'callback']);

Route::post('/Register', [RegController::class, 'RegUser']);

Route::post('/RegisterSeller',[RegController::class,'RegSeller']);

Route::post('/Login',[AuthLogin::class,'AuthUser']);

Route::get('/CRUIDSeller', function () {
    // Redirect to home or a default seller page
    return view('CRUIDSeller');
});

Route::post('/CRUIDSeller',[CRUIDSellerController::class,'AddProductCoffeeBeen']);

Route::post('/Carousel',[CarouselController::class,'AddAds']);

Route::post('/Carousel_Edit/{seller}',[CarouselController::class,'UpdateAds']);

Route::post('/edit_produk/{id}/{user}', [CRUIDSellerController::class, 'UpdateProductCoffeeBeen']);

Route::post('/add_stock',[CRUIDSellerController::class,'Tambah_Stock']);

Route::post('/addshoppingcart',[ShoppingCartController::class,'AddShoppingCart']);

Route::post('/Edit_Profile/{user}',[RegController::class,'EditProfile']);

Route::post('add_awb_bill/{user}',[CRUIDSellerController::class,'Add_AWB_Bill']);

Route::post('/forgot-password',[ResetPasswordController::class,'forgotpassword'])->middleware('guest')->name('password.email');

Route::post('/reset-password', [ResetPasswordController::class, 'resetpassword'])->middleware('guest')->name('password.update');

Route::post('/add_event/{user}',[CRUIDSellerController::class,'Save_Add_Event']);

Route::post('/edit_event/{user}',[CRUIDSellerController::class,'Save_Edit_Event']);

Route::post('Joint_Event',[EventController::class,'Save_Joint_Event']);