<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use App\Purchase;
use App\Like_function;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateProductData;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //一覧表示(トップページなど)
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
            $q->orWhere("name", "LIKE", "%{$keyword}%") //1こだけの検索(productテーブルと指定する必要なし)
            ->orWhere("detail", "LIKE", "%{$keyword}%");
        }

        $products = $q->orderBy('created_at','desc')->get(); //商品名なども全て検索かける(最終的にforeachで回す)
    
    
        $user = Auth::user();
        //dd($user);

        if(Auth::user()->role == 1){
        return view('products.index',[
            'products' => $products,
            'user' => $user,
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
        $user = Auth::user();
        $like_function = new Like_function;
        // ユーザの投稿の一覧を作成日時の降順で取得
        //withCount('テーブル名')とすることで、リレーションの数も取得できる(product_show.bladeの{$post->likes_count}の箇所)
        //$posts = Like_function::withCount('like_functions')->paginate(10);
        

        return view('products.product_show',[
        //     //左側のproductがshow.bladeで使える変数になる
            'product'=>$product,
            'user'=>$user,
            'like_function'=>$like_function,
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
        return redirect()->route('mypage.show',['mypage'=>Auth::id()]); //URLが{product}のように波括弧で囲まれている時の記述の仕方
    }
    //商品の購入処理
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

    //いいね機能
        public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $products_id = $request->products_id;
        $like_function = new Like_function;
        $product = Product::findOrFail($products_id);

        // 空でない（既にいいねしている）なら
        if ($like_function->like_exists($id, $products_id)) {
            //likesテーブルのレコードを削除
            $like_function = Like_function::where('products_id', $products_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like_function = new Like_function;
            $like_function->products_id = $request->products_id;
            $like_function->user_id = Auth::user()->id;
            $like_function->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        //$productLikesCount = $product->loadCount('like_functions')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいい
        // $json = [
        //     'productLikesCount' => $productLikesCount,
        // ];
        //下記の記述でajaxに引数の値を返す
        return response()->json();
    }

    //いいね一覧
    public function likeShow(int $user)
    {
        $like_function = new Like_function;
        // $like_functions = $like_function->where('user_id',Auth::id())->get(); 
        // $products = $product->where('user_id',Auth::id())->get(); //ログインしたユーザーの商品情報が欲しい→Auth::の記述必要
        $users = DB::table('like_functions') //テーブル名なので複数形
            ->join('products','like_functions.products_id','products.id') //2つのテーブルのjoin
            ->where('like_functions.user_id',Auth::id()) //ログインしたユーザーのid
            ->get();
        // dd($users);
        return view('products.like_list',[
        //     //左側のproductがshow.bladeで使える変数になる
            'users'=>$users,
            
        ]);
    }
    

}
