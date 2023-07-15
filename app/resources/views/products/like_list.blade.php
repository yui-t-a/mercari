<!-- いいねした商品一覧 -->
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class='text-center'>いいねした商品</h4>
        <div class="col d-flex flex-wrap">
            @foreach($users as $user)   
            <div class="card">           
                
                    <img src="{{ asset('storage/folder/'.$user->image_file_products )}}" class="card-img-top" alt="商品画像">
                
                    <label for="name" class="form-label">商品名</label>
                    <h5 class="text-center">{{ $user->name }}</h5>
                    <label for="price" class="form-label">価格</label>
                    <h5 class="text-center">¥{{ $user->price }}</h5>
            </div>
            @endforeach
        </div>
    </div> 
</div>
@endsection    