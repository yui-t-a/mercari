<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //管理者画面トップページ
    public function index(Request $request)
    {
        
        //return view()の中にはviewsフォルダの中のbladeの名前を書く
            return view('products/admin');
    }
    //個別ページ表示(マイページなどの詳細ページ。今回はユーザーリスト)
    public function userShow(User $user)
    {
        //userテーブルの中のidカラムを取得する
        $user_lists = User::where('role',1)->orderBy("id")->paginate(10);
        //dd($user_list);
		return view("products.userlist_admin", [
			"user_lists" => $user_lists
		]);
        
    }
    public function productListShow(Product $product)
    {
        //userテーブルの中のidカラムを取得する
        $product_lists = Product::orderBy("id")->paginate(10);
        //dd($product_lists);
		return view("products.productlist_admin", [
			"product_lists" => $product_lists
		]);
        
    }
    //ユーザーの利用停止
    public function userStop(int $id) //ユーザーのid
    {
        $user = new User;
        $users = $user->find($id);
        $users['user_flg'] = 1;
        $users->save();

        return redirect('/admin/userlist');
    }
    //ユーザーの利用再開
    public function userStart(int $id) //ユーザーのid
    {
        $user = new User;
        $users = $user->find($id);
        $users['user_flg'] = 0;
        $users->save();

        return redirect('/admin/userlist');
    }
    //商品の出品停止処理
    public function productStop(int $id) //ユーザーのid
    {
        $product = new Product;
        $products = $product->find($id);
        $products['product_flg'] = 1;
        $products->save();

        return redirect('/admin/productlist');
    }
    //商品の出品再開処理
    public function productStart(int $id) //ユーザーのid
    {
        $product = new Product;
        $products = $product->find($id);
        $products['product_flg'] = 0;
        $products->save();

        return redirect('/admin/productlist');
    }
}
