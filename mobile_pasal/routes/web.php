<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});
// route to go conroller and its function
Route::get('admin',[AdminController::class,'index']);


//route to accept the request post
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');


Route::group(['middleware'=>'admin_auth'],function(){
Route::get('admin/dashboard',[AdminController::class,'dashboard']);
Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/manage_category',[CategoryController::class,'manage_category']);
Route::get('admin/updatepassword',[AdminController::class,'updatepassword']);
Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN',true);
    session()->forget('ADMIN_ID',$result->id);
   session()->flash('error','Logout sucessful');
       return redirect('admin');
   
});
});
