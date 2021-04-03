<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@Index')->name("home");
Route::get('/all-product', 'ProductController@AllProduct')->name('allproduct');
Route::get('/search-product', 'ProductController@Search')->name('search');
Route::get('/product-details/{product_slug}', 'ProductController@DetailsProduct')->name('details');
/*Đăng ký*/
Route::post('/dangky','HomeController@dangky')->name('dangky');
/*Đăng nhập*/
Route::post('/dangnhap','HomeController@dangnhap')->name('dangnhap');
/*Đăng xuất*/
    Route::get('logout', function(){
        session()->flush();
        
        return redirect(route("home"));
    })->name('logout');