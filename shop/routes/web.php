<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorySearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckQuantityController;
use App\Http\Controllers\CustomerController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('index');

require __DIR__.'/auth.php';


// detail product

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('detail');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
   // Route::get('{id}/check-quantity', [CheckQuantityController::class, 'checkQuantity'])->name('check-quantity');


});

// search category

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/search/{id}', [CategorySearchController::class, 'search'])->name('search');

});


// cart
Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/cart-info', [CartController::class, 'getCartInfo'])->name('cart-info');//->middleware('check_order_step_by_step');
    Route::post('cart/{id}', [CartController::class, 'addCart'])->name('add-cart');

    // Route::put('/update-cart/{id}',[CartController::class,'updateCart'])->name('update-cart');
    Route::post('/update-cart',[CartController::class,'updateCart'])->name('update-cart');
    Route::get('/remove-cart/{id}',[CartController::class,'removeCart'])->name('remove-cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');//->middleware('check_order_step_by_step');
    Route::post('checkout-complete', [CartController::class, 'checkoutComplete'])->name('checkout-complete');
    Route::get('/order-complete', [CartController::class, 'orderComplete'])->name('order-complete');//
    Route::post('send-verify-code', [CartController::class, 'sendVerifyCode'])->middleware(['auth'])->name('send-verify-code');
    Route::post('confirm-verify-code', [CartController::class, 'confirmVerifyCode'])->middleware(['auth'])->name('confirm-verify-code');
});

// order history
Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/list-order', [OrderController::class, 'listOrder'])->middleware(['auth'])->name('list-order');
    Route::get('/cancel-order/{id}', [OrderController::class, 'cancelOrder'])->middleware(['auth'])->name('cancel-order');
    Route::get('/order-detail/{id}', [OrderController::class, 'orderDetail'])->middleware(['auth'])->name('order-detail');

});

// customer
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/profile', [CustomerController::class, 'profile'])->middleware(['auth'])->name('profile');
    Route::get('/edit-profile', [CustomerController::class, 'editProfile'])->middleware(['auth'])->name('edit-profile');
    Route::put('/update-profile/{id}', [CustomerController::class, 'updateProfile'])->middleware(['auth'])->name('update-profile');
    Route::get('/change-password', [CustomerController::class, 'changePassword'])->middleware(['auth'])->name('change-password');
    Route::post('/update-password', [CustomerController::class, 'updatePassword'])->middleware(['auth'])->name('update-password');
});


////test mail
// Route::get('send-mail', function () {

//     $details = [
//         'title' => 'Mail from ItSolutionStuff.com',
//         'body' => 'This is for testing email using smtp'
//     ];

//     \Mail::to('namhoang191097@gmail.com')->send(new \App\Mail\Testmail($details));

//     return "email send";
// });


/// test
///Route::get('/view-test',[CartController::class,'view_test'])->name('view_test');
