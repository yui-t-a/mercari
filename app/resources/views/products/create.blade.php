@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class='text-center'>商品の情報を入力</h4>
            <!-- バリデーション
            <div class="panel-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div> -->
        <!-- 登録する処理を行うメソッド -->
        <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="mb-3">
                <label for="image_file_products" class="form-label">写真をアップロード</label>
                <input type="file" class="form-control-file" name="image_file_products" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">商品名</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="situation" class="form-label">商品の状態</label>
                <input type="text" class="form-control" name="situation" required>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">商品の説明</label>
                <input type="text" class="form-control" name="detail" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <input type="text" class="form-control" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">出品する</button>
            
        </form>
        </div>
    </div>
</div>
@endsection
