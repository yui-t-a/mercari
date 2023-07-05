@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8">
    <h4 class='text-center'>マイページ</h4>
    </div>
    <div class="d-flex flex-row">
    <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="アイコン画像">
    <h5 class='text-center'>ユーザー名</h5>
        
        <button type="submit" class="btn btn-outline-secondary">フォロー</button>
        <button type="submit" class="btn btn-outline-secondary">いいねした商品</button>
        <form action="{{ route('product.create')}}">
            <button type="submit" class="btn btn-danger">出品する</button>
        </form>
        <button type="submit" class="btn btn-outline-danger">出品一覧</button>
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap">
        @foreach($products as $product)   
        <div class="card">
             
            <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">
            <div class="card-body">
                <h5 class="card-title">{{ $product['name']}}</h5>
                <p class="card-text">¥{{ $product['price']}}</p>
            </div>
           
        </div>
        @endforeach
    </div>
</div>

@endsection