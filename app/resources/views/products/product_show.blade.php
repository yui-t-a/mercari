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
                <p class="text-center">{{ $product['situation']}}</p>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">商品の説明</label>
                <p class="text-center">{{ $product['detail']}}</p>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <p class="text-center">¥{{ $product['price']}}</p>
            </div>
            <a href="{{ route('product.buy',['id' => $product['id']]) }}" class="btn btn-danger">購入する</a>
        </form>
        <div class="mb-3">
            @if($like_model->like_exist(Auth::user()->id,$post->id))
            <p class="favorite-marke">
            <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                <span class="likesCount">{{$post->likes_count}}</span>
            </p>
            @else
            <p class="favorite-marke">
            <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                <span class="likesCount">{{$post->likes_count}}</span>
            </p>
            @endif
        </div>
            <div class="mb-3">   
                
                    <!-- productController内showにて$productを使用出来るよう記述しているため$productを使用 -->      
                    <a href="{{ route('other.user',['id' => $product['user_id']])}}">出品者</a>
                         
            </div> 
        </div>
    </div>
</div>

@endsection