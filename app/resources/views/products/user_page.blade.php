<!-- 他ユーザーの紹介ページ -->
@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8">
    <h4 class='text-center'>出品者</h4>
    </div>
    <div class="d-flex flex-row">
        @if(isset($user->image_file_name))
        <img src="{{ asset('storage/profile/'.$user->image_file_name)}}" class="card-img-top" alt="アイコン画像" style="width:100px;">
        @else
        <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top" alt="noimage" style="width:150px;">
        @endif
        <!-- <img src="{{ asset('storage/profile/'.$user->image_file_name)}}" class="card-img-top w-25" alt="アイコン画像"> -->
        <h5 class='text-center'>ユーザー名</h5>
        <p class="card-text">{{ $user->name }}</p>
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
        <div class="card-body">
                <h5 class="card-title">紹介文</h5>
                <p class="card-text">{{ $user->comment }}</p>
        </div>                
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap">
        @foreach($products as $product)   
        <div class="card">           
            
                <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">
                  
        </div>
        @endforeach
    </div>
</div>

@endsection