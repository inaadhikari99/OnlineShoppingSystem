<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[FrontController::class,'index']);

Route::get('product/{id}',[FrontController::class,'product']);
Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('cart',[FrontController::class,'cart']);




// route to go conroller and its function
Route::get('admin',[AdminController::class,'index']);


//route to accept the request post
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');


Route::group(['middleware'=>'admin_auth'],function(){
Route::get('admin/dashboard',[AdminController::class,'dashboard']);
Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
 Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
 Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
// // Route::get('admin/updatepassword',[AdminController::class,'updatepassword']);
Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);



//for coupon

Route::get('admin/coupon',[CouponController::class,'index']);
Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
 Route::get('admin/coupon/manage_coupon/{id}',[CouponController::class,'manage_coupon']);
 Route::post('admin/coupon/manage_coupon_process',[CouponController::class,'manage_coupon_process'])->name('coupon.manage_coupon_process');

Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
Route::get('admin/coupon/status/{status}/{id}',[CouponController::class,'status']);



// for size
Route::get('admin/size',[SizeController::class,'index']);
Route::get('admin/size/manage_size',[SizeController::class,'manage_size']);
 Route::get('admin/size/manage_size/{id}',[SizeController::class,'manage_size']);
 Route::post('admin/size/manage_size_process',[SizeController::class,'manage_size_process'])->name('size.manage_size_process');

Route::get('admin/size/delete/{id}',[SizeController::class,'delete']);
Route::get('admin/size/status/{status}/{id}',[SizeController::class,'status']);


//for color
Route::get('admin/color',[ColorController::class,'index']);
Route::get('admin/color/manage_color',[ColorController::class,'manage_color']);
Route::get('admin/color/manage_color/{id}',[ColorController::class,'manage_color']);
Route::post('admin/color/manage_color_process',[ColorController::class,'manage_color_process'])->name('color.manage_color_process');

Route::get('admin/color/delete/{id}',[ColorController::class,'delete']);
Route::get('admin/color/status/{status}/{id}',[ColorController::class,'status']);




//for products
Route::get('admin/product',[ProductController::class,'index']);
Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
Route::get('admin/product/manage_product/{id}',[ProductController::class,'manage_product']);
Route::post('admin/product/manage_product_process',[ProductController::class,'manage_product_process'])->name('product.manage_product_process');

Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
Route::get('admin/product/status/{status}/{id}',[ProductController::class,'status']);

Route::get('admin/product/product_attr_delete/{paid}/{pid}',[ProductController::class,'product_attr_delete']);
Route::get('admin/product/product_images_delete/{paid}/{pid}',[ProductController::class,'product_images_delete']);

//for customer
Route::get('admin/customer',[CustomerController::class,'index']);


Route::get('admin/customer/show/{id}',[CustomerController::class,'show']);
Route::get('admin/customer/status/{status}/{id}',[CustomerController::class,'status']);



//for banner
Route::get('admin/banner',[BannerController::class,'index']);
Route::get('admin/banner/manage_banner',[BannerController::class,'manage_banner']);
Route::get('admin/banner/manage_banner/{id}',[BannerController::class,'manage_banner']);
Route::post('admin/banner/manage_banner_process',[BannerController::class,'manage_banner_process'])->name('banner.manage_banner_process');

Route::get('admin/banner/delete/{id}',[BannerController::class,'delete']);
Route::get('admin/banner/status/{status}/{id}',[BannerController::class,'status']);






Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
   session()->flash('error','Logout successful!!');
       return redirect('admin');
    
});

});
