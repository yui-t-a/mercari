<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //モデルのインスタンスを形成し、変数に代入
        $product = new Product;
        //productモデルから全件取得、配列化
        $eloquent = $product->all()->toArray();

        //検索
        $first = $request->input('first'); //inputタグに選択されたものが取得出来る
        $last = $request->input('last');

        $keyword = $request->input('keyword');
        
        //全件取得(productテーブル分)
        $q = Product::query()->where('product_flg',0); //出品停止のものは表示させない

        //金額検索
        if (isset($first) && isset($last)) {
            $q->whereBetween("price", [$first,$last]); //〜から〜までの検索
        }
        if (isset($keyword)) {
            //productテーブルの中のnameカラムの中で$keywordにヒットしたワードが出てくる(商品名＆商品説明)
            $q->where("name", "LIKE", "%{$keyword}%") //1こだけの検索(productテーブルと指定する必要なし)
            ->orWhere("detail", "LIKE", "%{$keyword}%");
        }

        $products = $q->get(); //商品名なども全て検索かける(最終的にforeachで回す)
   
        return view('toppage',[
            'products' => $products,
            'keyword' => $keyword,
        ]);
        
    
    }
    // public function productDetail(Product $product)
    // {
    //     $like_function = new Like_function;
    //     // ユーザの投稿の一覧を作成日時の降順で取得
    //     //withCount('テーブル名')とすることで、リレーションの数も取得できる(product_show.bladeの{$post->likes_count}の箇所)
    //     //$posts = Like_function::withCount('like_functions')->paginate(10);
        

    //     return view('products.product_show',[
    //     //     //左側のproductがshow.bladeで使える変数になる
    //         'product'=>$product,
            
    //         'like_function'=>$like_function,
    //     ]);
    // }
}
