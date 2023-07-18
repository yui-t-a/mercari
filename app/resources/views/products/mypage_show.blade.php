@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8 text-center">
    <h5 class='text-center'>マイページ</h5>
    </div>
    <div class="d-flex flex-row">
        <!-- class="w-25"で画像の幅を小さく指定 -->
        @if(isset(Auth::user()->image_file_name))
        <img src="{{ asset('storage/profile/'.Auth::user()->image_file_name)}}" class="card-img-top w-25" alt="アイコン画像">
        @else
        <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top w-25" alt="noimage" width="100">
        @endif
        <h5 class='text-center'>ユーザー名</h5>
        <p class="card-text">{{ Auth::user()->name }}</p>
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
                <div class="card-body">
            </a>
                <h5 class="card-title">紹介文</h5>
                <p class="card-text">{{ Auth::user()->comment }}</p>
        
    </div>  
    <div class="d-flex flex-row">
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