@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8">
    <h4 class='text-center'>マイページ</h4>
    </div>
    <div class="d-flex flex-row">
    <img src="{{ asset('storage/profile/'.Auth::user()->image_file_name)}}" class="card-img-top" alt="アイコン画像">
    <h5 class='text-center'>ユーザー名</h5>
    <!-- ページ遷移させたいname(波括弧の中)をパラメーターの左側に記述する -->
            <a href="{{ route('mypage.edit',['mypage' => Auth::id()])}}">
                <button type="button" class="btn btn-outline-secondary">プロフィールを編集する</button>
            </a>
        
            <button type="submit" class="btn btn-outline-secondary">フォロー</button>
        <button type="submit" class="btn btn-outline-secondary">いいねした商品</button>
        <div class="card-body">
                <h5 class="card-title">紹介文</h5>
                <p class="card-text">{{ Auth::user()->comment }}</p>
        </div>
        <a href="{{ route('product.history',['id' => Auth::id()])}}">
            <button type="submit" class="btn btn-danger">購入した商品</button>
        </a>
        <button type="submit" class="btn btn-outline-danger">売上履歴</button>
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap">
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