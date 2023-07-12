<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        //モデルのインスタンスを形成し、変数に代入
        $product = new Product;
        //productモデルから全件取得、配列化
        $eloquent = $product->all()->toArray();
        //dd($eloquent);
        if(Auth::user()->role == 1){
        return view('products.index',[
            'products' => $eloquent,
        ]);
    } else {
        return view(
            'products.admin'
        );
    }
    }
    //ユーザーの出品商品一覧
    public function productIndex()
    {
        $product = new Product;
        $products = $product->where('user_id',Auth::id())->get(); //ログインしたユーザーの商品情報が欲しい→Auth::の記述必要
        
        return view('products.product_index',[
            //     //左側のproductがshow.bladeで使える変数になる、右側の$productが(↑の$user = $product->where('user_id',Auth::id())->get();の情報が入っている)
                'products'=>$products
                
            ]);

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

        return redirect('/product'); //ログイン後に一番最初に表示されるページ
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //個別ページ表示(マイページなどの詳細ページ。今回は商品詳細)
    public function show(Product $product)
    {
        return view('products.product_show',[
        //     //左側のproductがshow.bladeで使える変数になる
            'product'=>$product    
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    //編集用のフォームを表示
    public function edit(Product $product) //$productでクリックした商品の値が取れる
    {
        //dd($product);
        //$product = new product;
        
        //productテーブルの中のuser_idカラムでログインしたユーザーのidを取得する
        //$user = $product->where('id',Auth::id())->get();
        //dd($user);
            return view('products.product_edit',[
                //左側のuserがshow.bladeで使える変数になる
                'product'=>$product  
            ]);
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
        $image = $request->file('image_file_products');
        if(isset($image)){
        //画像だけファイル名を変える必要があるため、foreachと別に記述する
        $dir = 'folder';
        //元々付いている画像の名前を取得
        $file_name = $request->file('image_file_products')->getClientOriginalName();
        // folderディレクトリに画像を保存
        $request->file('image_file_products')->storeAs('public/' . $dir, $file_name);
        $product->image_file_products = $file_name;
        
        }
        $columns = ['name','situation','detail','price'];
        foreach($columns as $column){
            $product->$column = $request->$column; //requestが保存された値をcontrollerに保存される
        }
        $product->save();
        return redirect('/product');
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
        $product->delete();
        return redirect()->route('product.show',$product->id); //URLが{product}のように波括弧で囲まれている時の記述の仕方
    }
    public function productCreate(int $product_id) //商品のID
    {
        return view('products.product_create',[
        'product_id'=>$product_id
    ]);
        
    }
    //商品購入時のユーザー情報登録(usersテーブル、purchasesテーブルに登録)
    public function productStore(Request $request,int $products_id)
    {
        $users = new User;
        $user = $users->find(Auth::id()); //ログインしているユーザー情報を持ってくる 
        
        $user->name = $request->name;
        $user->tel = $request->tel;
        $user->zipcode = $request->zipcode;
        $user->address = $request->address;

        $user->save();
 
        //購入画面での入力値は新規登録
        $purchases = new Purchase;
        $purchases->user_id = Auth::id();//ログインしているユーザのID
        $purchases->products_id = $products_id; 

        $purchases->save();

        return redirect('/product');


    }

}
