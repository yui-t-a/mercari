@extends('layouts.app')

@section('content')
<div class="">
    <div class="text-center">
    <h5 class='text-center'>マイページ</h5>
    </div>
    <div class="d-flex m-3">
        <div class="">
            <div class="d-flex flex-row justify-content-center m-5">
                <!-- class="w-25"で画像の幅を小さく指定 -->
                @if(isset(Auth::user()->image_file_name))
                <img src="{{ asset('storage/profile/'.Auth::user()->image_file_name)}}" class="card-img-top" alt="アイコン画像" style="width:100px;">
                @else
                <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top" alt="noimage" width="width:100px;">
                @endif
            </div> 
            <div class="flex-column justify-content-center">
                <p class='text-center'>ユーザー名</p>
                <h5 class="text-center">{{ Auth::user()->name }}</h5>
            </div>  
            <div class="flex-column justify-content-center">
                <p class="text-center">紹介文</p>
                <h5 class="text-center">{{ Auth::user()->comment }}</h5>
            </div>
        </div>
        <div class ="d-flex flex-column justify-content-center m-2">
                @if($user['user_flg'] == 0)
                <!-- ページ遷移させたいname(波括弧の中)をパラメーターの左側に記述する -->
                <a href="{{ route('mypage.edit',['mypage' => Auth::id()])}}">
                    <button type="button" class="btn btn-outline-secondary" style="width:30vw;">プロフィールを編集する</button>
                </a>
                @endif
                <div class="d-flex flex-column justify-content-center my-3">
                    <a href="{{ route('follow.list',['id' => Auth::id()])}}">
                        <button type="submit" class="btn btn-outline-secondary" style="width:30vw;">フォローユーザー</button>
                    </a>
                    <div class="my-3">
                    <a href="{{ route('like.list',['id' => Auth::id()])}}">
                        <button type="submit" class="btn btn-outline-secondary" style="width:30vw;">いいねした商品</button>
                        
                        
                    </a>
                    </div>
                </div>  
        
    
            <div class="flex-column mb-2">
                
                <a href="{{ route('product.history',['id' => Auth::id()])}}">
                    <button type="submit" class="btn btn-outline-danger" style="width:30vw;">購入した商品</button>
                </a>
                <a href="{{ route('product.soldout',['id' => Auth::id()])}}">
                    <button type="submit" class="btn btn-outline-danger" style="width:30vw;">売上履歴</button>
                </a>
            </div>
        </div>

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