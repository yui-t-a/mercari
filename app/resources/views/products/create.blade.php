@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class='text-center'>商品の情報を入力</h4>
        <!-- 登録する処理を行うメソッド -->
        <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="image_file_products" class="form-label">写真をアップロード</label>
                <input type="file" class="form-control-file" name="image_file_products">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">商品名</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="situation" class="form-label">商品の状態</label>
                <input type="text" class="form-control" name="situation">
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">商品の説明</label>
                <input type="text" class="form-control" name="detail">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <input type="text" class="form-control" name="price">
            </div>
            <button type="submit" class="btn btn-danger">出品する</button>
            
        </form>
        </div>
    </div>
</div>
@endsection
