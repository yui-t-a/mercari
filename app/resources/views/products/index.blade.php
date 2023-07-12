@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex flex-row">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            下限価格
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">3,000円以上</a></li>
            <li><a class="dropdown-item" href="#">5,000円以上</a></li>
            <li><a class="dropdown-item" href="#">10,000円以上</a></li>
            <li><a class="dropdown-item" href="#">15,000円以上</a></li>
            <li><a class="dropdown-item" href="#">20,000円以上</a></li>
            <li><a class="dropdown-item" href="#">30,000円以上</a></li>
        </ul>
    </div>〜<div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            上限価格
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">3,000円未満</a></li>
            <li><a class="dropdown-item" href="#">5,000円未満</a></li>
            <li><a class="dropdown-item" href="#">10,000円未満</a></li>
            <li><a class="dropdown-item" href="#">15,000円未満</a></li>
            <li><a class="dropdown-item" href="#">20,000円未満</a></li>
            <li><a class="dropdown-item" href="#">30,000円未満</a></li>
        </ul>
    </div>
    </div>
    <div class="d-flex flex-row">
        <input type="text" class="form-control" name="product_id">
        <button type="submit" class="btn btn-outline-secondary">検索する</button>
        <form action="{{ route('product.create')}}">
            <button type="submit" class="btn btn-danger">出品する</button>
        </form>
        <!-- web.phpの波括弧の中と['〜'=>]の〜の記述は合わせる -->
        <form action="{{ route('product.index',['id' => Auth::user()->id])}}"> 
            <button type="submit" class="btn btn-outline-danger">出品一覧</button>
        </form>
    </div>
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