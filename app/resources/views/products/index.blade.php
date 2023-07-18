@extends('layouts.app')

@section('content')
@if($user['user_flg'] == 1)
<p>利用停止されています</p>
@endif
<!-- controller側に値を持っていく場合、inputタグ、selectタグで囲む必要がある(検索機能) -->
<form action="{{ route('product.index')}}" method="get">
    <div class="card-body">
        <div class="d-flex flex-row">
            <div class="mx-1">
                <select name="first" id="">
                    <option value="">下限金額を選択</option>
                    <option value="3000">3,000円以上</option>
                    <option value="5000">5,000円以上</option>
                    <option value="10000">10,000円以上</option>
                    <option value="15000">15,000円以上</option>
                    <option value="20000">20,000円以上</option>
                    <option value="30000">30,000円以上</option>
                </select>
            </div>
            <div class="mx-1">
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
            
            <div class="input-group mx-1">
                <input type="text" class="form-control" name="keyword" placeholder="キーワードを入力">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i> 検索</button>
            </div>
        </div>
</form>
    <div class="d-flex flex-row">
    <div class="mx-2">
    @if($user['user_flg'] == 0)
        <form action="{{ route('product.create')}}">
            <button type="submit" class="btn btn-primary">出品する</button>
        </form>
        </div> 
        <!-- web.phpの波括弧の中と['〜'=>]の〜の記述は合わせる -->
        <form action="{{ route('product.list',['id' => Auth::user()->id])}}"> 
            <button type="submit" class="btn btn-outline-primary">出品一覧</button>
        </form>
    @endif       
    </div>
</div>
<div class="">
    <div class="col d-flex flex-wrap justify-content-center">
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