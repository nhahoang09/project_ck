<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorySearchController;
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

});

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/search/{id}', [CategorySearchController::class, 'search'])->name('search');

});

// sử dụng check Authentication
// Route::group(['middleware' => 'auth'], function () {
// }
// cart

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
    Route::get('/cart-info', [CartController::class, 'getCartInfo'])->name('cart-info');//->middleware('check_order_step_by_step');
    Route::post('cart/{id}', [CartController::class, 'addCart'])->name('add-cart');

    Route::post('/update-cart/{id}',[CartController::class,'updateCart'])->name('update-cart');
    Route::get('/remove-cart/{id}',[CartController::class,'removeCart'])->name('remove-cart');

    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('check_order_step_by_step');
    Route::post('checkout-complete', [CartController::class, 'checkoutComplete'])->name('checkout-complete');
    Route::post('send-verify-code', [CartController::class, 'sendVerifyCode'])->middleware(['auth'])->name('send-verify-code');
    Route::post('confirm-verify-code', [CartController::class, 'confirmVerifyCode'])->middleware(['auth'])->name('confirm-verify-code');
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
