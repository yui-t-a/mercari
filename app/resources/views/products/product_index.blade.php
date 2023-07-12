@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class='text-center'>出品した商品</h4>
        <div class="col d-flex flex-wrap">
            @foreach($products as $product)   
            <div class="card">           
                <a href="{{ route('product.edit',['product' => $product['id']])}}">
                    <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像">
                
                    <label for="name" class="form-label">商品名</label>
                    <h5 class="text-center">{{ $product['name']}}</h5>
                </a>           
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection    