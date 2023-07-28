<!-- 他ユーザーの紹介ページ -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h5 class='text-center'>出品者</h5>
    </div>
    <div class="d-flex flex-row justify-content-center my-5">
        @if(isset($user->image_file_name))
        <img src="{{ asset('storage/profile/'.$user->image_file_name)}}" class="card-img-top" alt="アイコン画像" style="width:100px;">
        @else
        <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top" alt="noimage" style="width:150px;">
        @endif
        <div class="flex-column justify-content-center mx-5">
            <p class='text-center'>ユーザー名</p>
            <h5 class="card-text">{{ $user->name }}</h5>
        </div>
        
        <div class="flex-column justify-content-center mx-5">
                <p class="text-center">紹介文</p>
                <h5 class="card-text">{{ $user->comment }}</h5>
        </div>                
        <div class="my-4">
            @if(empty($follows))
                <!-- ページ遷移させたいname(波括弧の中)をパラメーターの左側に記述する -->
                <a href="{{ route('follow.user',$user->id)}}">
                    <button type="button" class="btn btn-outline-secondary">フォローする</button>
                </a>
                @else
                <a href="{{ route('unfollow.user',$user->id)}}">
                    <button type="button" class="btn btn-outline-secondary">フォロー解除</button>
                </a>
            @endif
        </div>
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap justify-content-center">
        @foreach($products as $product)   
        <div class="card">           
            
                <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">
                  
        </div>
        @endforeach
    </div>
</div>
</div>
</div>

@endsection