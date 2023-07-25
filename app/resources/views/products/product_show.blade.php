<!-- 商品詳細画面 -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class='text-center'>商品詳細</h4>
        <!-- 登録する処理を行うメソッド -->
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">   
                <!-- productcontroller内showにて$productを使用出来るよう記述 -->        
                <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">            
            </div> 
            <div class="mb-3">
                <label for="name" class="form-label">商品名</label>
                <h5 class="text-center">{{ $product['name']}}</h5>
            </div>
            <div class="mb-3">
                <label for="situation" class="form-label">商品の状態</label>
                <h5 class="text-center">{{ $product['situation']}}</h5>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">商品の説明</label>
                <h5 class="text-center">{{ $product['detail']}}</h5>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <h5 class="text-center">¥{{ $product['price']}}</h5>
            </div>
            @if($user['user_flg'] == 0)
            <div class="my-1 mx-2">
                <a href="{{ route('product.buy',['id' => $product['id']]) }}" class="btn btn-primary btn-block">購入する</a>
            
        </form>
        <div class="my-2">
            @if($like_function->like_exists(Auth::user()->id,$product['id']))
            <p class="favorite-marke">
            <button class="js-like-toggle loved" href="" data-postid="{{ $product['id'] }}"><i class="fas fa-heart"></i></button>
                
            </p>
            @else
            <p class="favorite-marke">
            <button class="js-like-toggle" href="" data-postid="{{ $product['id'] }}"><i class="fas fa-heart"></i></button>
                <span class="likesCount"></span>
            </p>
            @endif
            
            </div>
        </div>
            <div class="mb-3">   
                
                    <!-- productController内showにて$productを使用出来るよう記述しているため$productを使用 -->      
                    <a href="{{ route('other.user',['id' => $product['user_id']])}}">出品者</a>
                         
            </div> 
            @endif
        </div>
    </div>
</div>

@endsection
<style>
    .loved i{
        color: red !important;
    }
    .js-like-toggle{
        background-color: white;
        color: gray;
        border: none; 
    }
</style>