@extends('layouts.app')

@section('content')
<div class="">
    <div class="text-center">
    <h5 class='text-center'>マイページ</h5>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <!-- class="w-25"で画像の幅を小さく指定 -->
        @if(isset(Auth::user()->image_file_name))
        <img src="{{ asset('storage/profile/'.Auth::user()->image_file_name)}}" class="card-img-top" alt="アイコン画像" style="width:100px;">
        @else
        <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top" alt="noimage" width="width:100px;">
        @endif
        <div class="flex-column">
            <p class='text-center'>ユーザー名</p>
            <h5 class="card-text">{{ Auth::user()->name }}</h5>
        </div>
    </div>  
    <div class ="">    
            @if($user['user_flg'] == 0)
            <!-- ページ遷移させたいname(波括弧の中)をパラメーターの左側に記述する -->
            <a href="{{ route('mypage.edit',['mypage' => Auth::id()])}}">
                <button type="button" class="btn btn-outline-secondary">プロフィールを編集する</button>
            </a>
            @endif
            <div class="d-flex flex-row">
            <a href="{{ route('follow.list',['id' => Auth::id()])}}">
                <button type="submit" class="btn btn-outline-secondary">フォローユーザー</button>
            </a>
            <a href="{{ route('like.list',['id' => Auth::id()])}}">
                <button type="submit" class="btn btn-outline-secondary">いいねした商品</button>
                </div>
                
            </a>
                
        
    </div>  
    
    <div class="d-flex flex-row justify-content-center">
        <div class="flex-column">
            <p class="card-title">紹介文</p>
            <h5 class="card-text">{{ Auth::user()->comment }}</h5>
        </div>
        <a href="{{ route('product.history',['id' => Auth::id()])}}">
            <button type="submit" class="btn btn-danger">購入した商品</button>
        </a>
        <a href="{{ route('product.soldout',['id' => Auth::id()])}}">
            <button type="submit" class="btn btn-outline-danger">売上履歴</button>
        </a>
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap justify-content-center">
        @foreach($users as $user)   
        <div class="card">           
            <a href="{{ route('product.edit',['product' => $user['id']])}}">
                <img src="{{ asset('storage/folder/'.$user['image_file_products'])}}" class="card-img-top" alt="商品画像">
            </a>           
        </div>
        @endforeach
    </div>
</div>

@endsection