<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index']); //トップページへ遷移
//ログイン前の商品詳細
//Route::get('/product/{id}/detail', [HomeController::class,'productDetail'])->name('product.detail');
Auth::routes();


//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => 'auth'],function(){
Route::resource('product', 'ProductController');
Route::resource('mypage', 'MypageController');

Route::get('/product/{id}/buy',[ProductController::class,'productCreate'])->name('product.buy');
Route::post('/product/{id}/buy',[ProductController::class,'productStore']);
//商品の購入履歴
Route::get('/product/{id}/history',[MypageController::class,'purchaseShow'])->name('product.history');
//商品の売上履歴
Route::get('/product/{id}/soldout',[MypageController::class,'productSoldout'])->name('product.soldout');
//他ユーザーの紹介ページ表示
Route::get('/product/{id}/otheruser',[MypageController::class,'userShow'])->name('other.user');
//ユーザーのフォロー機能
Route::get('/product/{id}/follow',[MypageController::class,'followStoreForm'])->name('follow.user');
Route::post('/product/{id}/follow',[MypageController::class,'followStore']);
//ユーザーのアンフォロー機能
Route::get('/product/{id}/unfollow',[MypageController::class,'unfollowStoreForm'])->name('unfollow.user');
Route::post('/product/{id}/unfollow',[MypageController::class,'unfollowStore']);

//フォロー一覧表示
Route::get('/product/{id}/followlist',[MypageController::class,'followList'])->name('follow.list');

//いいね機能
Route::get('/product/{id}/index', [ProductController::class,'productLike'])->name('product.like');
//ajaxlike.jsファイルのurl:'ルーティング'に書くものと合わせる。
Route::post('/ajaxlike', [ProductController::class,'ajaxlike'])->name('product.ajaxlike');
Route::get('/product/{id}/index',[ProductController::class,'productIndex'])->name('product.list');

//いいね一覧
Route::get('/product/{id}/like', [ProductController::class,'likeShow'])->name('like.list');

//管理ユーザートップページ
Route::get('/admin', [Controller::class,''])->name('');

});