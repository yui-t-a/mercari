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
                <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">            
            </div> <!--['product' => Auth::image_file_products] ['product'=>Auth::user()->image_file_products]-->
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
            <button type="submit" class="btn btn-danger">購入する</button>
        </form>
        </div>
    </div>
</div>

@endsection