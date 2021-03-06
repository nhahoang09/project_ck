<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RegisterAdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
// Route::group(['prefix'=>'admin', 'as' => 'admin.'], function () {
//     Route::get('register', [RegisterAdminController::class, 'create'])->name('register');
//     Route::post('register', [RegisterAdminController::class, 'store'])->name('register.handle');
// });


Route::group(['middleware' => ['check_login_admin'] , 'as' => 'admin.'], function () {


    Route::get('login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.handle');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('register', [RegisterAdminController::class, 'create'])->name('register');
    Route::post('register', [RegisterAdminController::class, 'store'])->name('register.handle');



	// Admin Dashboard
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // route for module Category
	Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('index')->middleware('role');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('role');
        Route::post('/store', [CategoryController::class, 'store'])->name('store')->middleware('role');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show')->middleware('role');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('role',);
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update')->middleware('role');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('role');
    });

    // route for module Product
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/list', [ProductController::class, 'index'])->name('index')->middleware('role');
        Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('role');
        Route::post('/store', [ProductController::class, 'store'])->name('store')->middleware('role');
        Route::get('/show/{id}', [ProductController::class, 'show'])->name('show')->middleware('role');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit')->middleware('role');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update')->middleware('role');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('destroy')->middleware('role');
    });

    // route for module Order
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/list', [OrderController::class, 'index'])->name('index')->middleware('active');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show')->middleware('active');
        Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit')->middleware('active');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('update')->middleware('active');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('destroy')->middleware('role');
    });

    // route group for module ProductPrice and ProductPromotion
    Route::group(['prefix' => 'product/{product_id}', 'as' => 'product.'], function () {
        // route for module Price
        Route::group(['prefix' => 'price', 'as' => 'price.'], function () {
            Route::get('/list', [PriceController::class, 'index'])->name('index')->middleware('role');
            Route::get('/create', [PriceController::class, 'create'])->name('create')->middleware('role');
            Route::post('/store', [PriceController::class, 'store'])->name('store')->middleware('role');
            Route::get('/show/{id}', [PriceController::class, 'show'])->name('show')->middleware('role');
            Route::get('/edit/{id}', [PriceController::class, 'edit'])->name('edit')->middleware('role');
            Route::put('/update/{id}', [PriceController::class, 'update'])->name('update')->middleware('role');
            Route::delete('/delete/{id}', [PriceController::class, 'destroy'])->name('destroy')->middleware('role');
        });

    });

      // route for module Promotion
      Route::group(['prefix' => 'promotion', 'as' => 'promotion.'], function () {
        Route::get('/list', [PromotionController::class, 'index'])->name('index')->middleware('role');
        Route::get('/create', [PromotionController::class, 'create'])->name('create')->middleware('role');
        Route::post('/store', [PromotionController::class, 'store'])->name('store')->middleware('role');
        Route::get('/show/{id}', [PromotionController::class, 'show'])->name('show')->middleware('role');
        Route::get('/edit/{id}', [PromotionController::class, 'edit'])->name('edit')->middleware('role');
        Route::put('//update/{id}', [PromotionController::class, 'update'])->name('update')->middleware('role');
        Route::delete('/delete/{id}', [PromotionController::class, 'destroy'])->name('destroy')->middleware('role');
    });



      // route for module Customers
      Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('index')->middleware('role');
        Route::delete('/delete/{id}', [CustomerController::class, 'destroy'])->name('destroy')->middleware('role');
    });

     //route for module Slides
    Route::group(['prefix' => 'slide', 'as' => 'slide.'], function () {
        Route::get('/list', [SlideController::class, 'index'])->name('index')->middleware('role');
        Route::get('/create', [SlideController::class, 'create'])->name('create')->middleware('role');
        Route::post('/store', [SlideController::class, 'store'])->name('store')->middleware('role');
        Route::get('/show/{id}', [SlideController::class, 'show'])->name('show')->middleware('role');
        Route::get('/edit/{id}', [SlideController::class, 'edit'])->name('edit')->middleware('role');
        Route::put('/update/{id}', [SlideController::class, 'update'])->name('update')->middleware('role');
        Route::delete('/delete/{id}', [SlideController::class, 'destroy'])->name('destroy')->middleware('role');
    });

     // route for module User
     Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/list', [UserController::class, 'index'])->name('index')->middleware('role');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('role');
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('role');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show')->middleware('role');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit')->middleware('role');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update')->middleware('role');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy')->middleware('role');
    });
});
