<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $id = Auth::id();  //ログインユーザーのidを取得
        $record = $user->find($id);  //どのユーザーかを指定しないとDBへ保存できない

        //ディレクトリ名
        $dir = 'profile';
        //元々付いている画像の名前を取得
        $file_name_profile = $request->file('image_file_name')->getClientOriginalName();
        // folderディレクトリに画像を保存
        $request->file('image_file_name')->storeAs('public/' . $dir, $file_name_profile);

        //$user->user_id = 1; //ログイン処理実装後でauthのid持ってくる
        $record->image_file_name = $file_name_profile;
        $record->comment = $request->comment;        

        $record->save();

        return redirect()->route('product.show',$record->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //マイページの表示
    public function show(int $id) //ユーザのid
    {
        
        $product = new product; //$product = new product;
        
        //productテーブルの中のuser_idカラムでログインしたユーザーのidを取得する
        $user = $product->where('user_id',Auth::id())->get();
        // dd($user);
        //return view()の中にはviewsフォルダの中のbladeの名前を書く
            return view('products/mypage_show',[
                //左側のuserがshow.bladeで使える変数になる、右側の$userが(↑の$user = $product->where('user_id',Auth::id())->get();の情報が入っている)
                'users'=>$user  
            ]);
            
    }
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) //ログインユーザーの情報が入っている
    {
        return view('products.mypage_edit',[
            //左側のuserがshow.bladeで使える変数になる、右側の$userが(↑の$user = $product->where('user_id',Auth::id())->get();の情報が入っている)
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //$idにログインユーザーの情報が入っている
    {
        $user = new User;
        $record = $user->find($id);   //どのユーザーかを指定しないとDBへ保存できない

        $image_prolile = $request->file('image_file_name');
        if(isset($image_prolile)){
            //画像だけファイル名を変える必要があるため、下記「}」の下の記述と別に記述する
            $dir = 'folder';
            //元々付いている画像の名前を取得
            $file_name_profile = $request->file('image_file_name')->getClientOriginalName();
            // folderディレクトリに画像を保存
            $request->file('image_file_name')->storeAs('public/' . $dir, $file_name_profile);
            $record->image_file_name = $file_name_profile;
            
        }
        $column = 'comment';
     
        $record->$column = $request->$column; //requestが保存された値をcontrollerに保存される
        $record->save();
        //redirect()の中にはURLを記述する、下記の様にURLでない(リダイレクトする際にidを渡したい等の)場合、route()の中に記述する
        return redirect()->route('product.show',$record->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //購入履歴の表示
    public function purchaseShow(int $id)
    {
        //$product = new product; →productテーブルから情報を取ってくるから記述不要
        
        //productテーブルの中のuser_idカラムでログインしたユーザーのidを取得する
        $users = DB::table('purchases') //テーブル名なので複数形
            ->join('products','purchases.products_id','products.id') //2つのテーブルのjoin
            ->where('purchases.user_id',Auth::id()) //購入履歴のテーブルから取ってくるため
            ->get();
            //dd($users);
        return view('products.purchase_history',[
            'users'=>$users
        ]);
    }
}
