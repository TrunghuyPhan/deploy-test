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
Route::get('/product-details/{product_id}', 'ProductController@DetailsProduct')->name('details');
/*Đăng ký*/
Route::post('/dangky', 'HomeController@dangky')->name('dangky');
/*Đăng nhập*/
Route::post('/dangnhap', 'HomeController@dangnhap')->name('dangnhap');
/*Đăng xuất*/
Route::get('logout', function () {
    session()->flush();
    // $tinh = DB::select("SELECT Tên FROM tinh");
    return redirect(route("home"));
})->name('logout');
// Chỉnh sua info KH
Route::get('/thongtin/{makh}', 'HomeController@Chinhsuainfo')->name('Chinhsuathongtin');
/* giỏ hàng */

Route::post('/save-cart', 'GioHangController@save_cart');
Route::post('/add-cart-ajax', 'GioHangController@add_cart_ajax');
Route::get('/show-cart', 'GioHangController@show_cart')->name('giohang');
Route::post('/update-cart-quantity', 'GioHangController@update_cart_quantity');
Route::post('/update-cart', 'GioHangController@update_cart');
Route::get('/delete-to-cart/{rowId}', 'GioHangController@delete_to_cart');
Route::get('/del-product/{session_id}', 'GioHangController@delete_product');
Route::get('/del-all-product', 'GioHangController@delete_all_product');

Route::get('/category-product/{category_id}', 'CategoryController@Category')->name('categoryproduct');

//admin
// Route::prefix('admin')->group(function () {

//     // Route::get('/', 'HomeController@Index')->name("home")->middleware(auth());
//     Route::match(['get', 'post'], '/login', 'AdminController@Login')->name('admin_login');
// });
Route::get('/admin/login', 'AdminController@GLogin');
Route::post('admin/login', 'AdminController@PLogin')->name('admin_login');

Route::prefix('admin')->group(function () {
    Route::get('/index', 'AdminController@index')->middleware('checkdangnhap')->name('admin_index');
    //Route::get('/themsanpham', 'AdminController@add_product')->middleware('checkdangnhap')->name('admin_add_pro');

    Route::get('logout', function () {
        session()->flush();
        return redirect(route("admin_login"));
    })->name('admin_logout');
});


////////////////////
Route::get('/add-product', 'ProductController@add_product')->middleware('checkdangnhap')->name('addproduct');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product')->middleware('checkdangnhap')->name('editproduct');

Route::post('/save-product', 'ProductController@save_product')->middleware('checkdangnhap');
Route::post('/update-product/{product_id}', 'ProductController@update_product')->middleware('checkdangnhap');

Route::get('/delete-product/{product_id}', 'ProductController@delete_product')->middleware('checkdangnhap')->name('deleteproduct');
