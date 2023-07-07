@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8">
    <h4 class='text-center'>出品商品編集</h4>
    </div>
    <!-- route()内にURLに入れるパラメーターを渡す -->
    <form action="{{ route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @method('PATCH')    <!-- rootlistに書いているMethodの内容を記述 -->
    @csrf
    <div class="d-flex flex-row">
    <div class="card">         
        <div class="mb-3">
            <!-- product_idが選択した商品のものを表示させる     -->
        <img src="{{ asset('storage/folder/'.$product['image_file_products'])}}" class="card-img-top" alt="商品画像"> 
                <label for="image_file_products" class="form-label">写真をアップロード</label>
                <input type="file" class="form-control-file" name="image_file_products">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">商品名</label>
                <input type="text" class="form-control" name="name" value="{{ $product['name']}}">
            </div>
            <div class="mb-3">
                <label for="situation" class="form-label">商品の状態</label>
                <input type="text" class="form-control" name="situation" value="{{ $product['situation']}}">
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">商品の説明</label>
                <input type="text" class="form-control" name="detail" value="{{ $product['detail']}}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <input type="text" class="form-control" name="price" value="{{ $product['price']}}">
            </div>
            <button type="submit" class="btn btn-danger">編集する</button>
        
    </div>
    
    </div>
    </form>
    <form action="{{ route('product.destroy',$product->id)}}" method="post">
    @method('delete')
    @csrf <!--フォームタグがある時に記述する必要がある -->
        <input type="submit" value="削除する" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
    </form>
</div>


@endsection