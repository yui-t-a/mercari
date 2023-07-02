<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧表示(トップページなど)
    public function index()
    {
        return view('products.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //新規登録の表示
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 新規登録処理をするためのメソッド
    public function store(Request $request)
    {
        $product = new product;
        //ディレクトリ名
        $dir = 'folder';
        //元々付いている画像の名前を取得
        $file_name = $request->file('image_file_products')->getClientOriginalName();
        // folderディレクトリに画像を保存
        $request->file('image_file_products')->storeAs('public/' . $dir, $file_name);

        $product->user_id = 1; //ログイン処理実装後でauthのid持ってくる
        $product->image_file_products = $file_name;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->detail = $request->detail;
        $product->situation = $request->situation;

        $product->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //個別ページ表示(マイページなどの詳細ページ)
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //編集用のフォームを表示
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //編集の処理をする
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //削除する処理
    public function destroy(Product $product)
    {
        //
    }
}
