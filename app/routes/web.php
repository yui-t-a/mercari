<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
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
Auth::routes();
Route::get('/', function () {
    return view('toppage'); //トップページへ遷移
});
Route::get('/product/{id}/buy',[ProductController::class,'productCreate'])->name('product.buy');
Route::post('/product/{id}/buy',[ProductController::class,'productStore']);
Route::get('/product/{id}/history',[MypageController::class,'purchaseShow'])->name('product.history');
Route::group(['middleware' => 'auth'],function(){
Route::resource('product', 'ProductController');
Route::resource('mypage', 'MypageController');
Route::get('/product/{id}/index',[ProductController::class,'productIndex'])->name('product.list');

});