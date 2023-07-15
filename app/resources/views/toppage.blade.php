<!-- トップページ(ログインしていない状態で閲覧できる画面) -->
@extends('layouts.app')

@section('content')
<!-- controller側に値を持っていく場合、inputタグ、selectタグで囲む必要がある(検索機能) -->
<form action="{{ route('product.index')}}" method="get">
    <div class="card-body">
        <div class="d-flex flex-row">
            <select name="first" id="">
                <option value="">下限金額を選択</option>
                <option value="3000">3,000円以上</option>
                <option value="5000">5,000円以上</option>
                <option value="10000">10,000円以上</option>
                <option value="15000">15,000円以上</option>
                <option value="20000">20,000円以上</option>
                <option value="30000">30,000円以上</option>
            </select>
            <select name="last" id="">
                <option value="">上限金額を選択</option>
                <option value="3000">3,000円未満</option>
                <option value="5000">5,000円未満</option>
                <option value="10000">10,000円未満</option>
                <option value="15000">15,000円未満</option>
                <option value="20000">20,000円未満</option>
                <option value="30000">30,000円未満</option>
            </select>
        
        </div>
        <input type="text" class="form-control" name="keyword">
            <button type="submit" class="btn btn-outline-secondary">検索する</button>
</form>
        
</div>
<div class="">
    <div class="col d-flex flex-wrap">
        @foreach($products as $product)   
        <div class="card">
            <a href="{{ route('product.show',['product' => $product['id']])}}">
                <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">  
                <div class="card-body">
                    <h5 class="card-title">{{ $product['name']}}</h5>
                    <p class="card-text">¥{{ $product['price']}}</p>
                </div>
            </a>  
        </div>
        @endforeach
    </div>
</div>

@endsection