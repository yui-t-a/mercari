<!-- 購入画面 -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class='text-center'>購入画面</h4>
        <!-- 登録する処理を行うメソッド -->
        <form action="{{ route('product.buy',['id' => $product_id])}}" method="post">
        @csrf
            <div class="mb-3">   
                           
            </div> 
            <div class="mb-3">
                <label for="name" class="form-label">氏名</label>
                <input type="text" name="name" required>
            </div>
            <div class="mb-3">
                <label for="situation" class="form-label">電話番号</label>
                <input type="text" name="tel" required>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">郵便番号</label>
                <input type="text" name="zipcode" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">住所</label>
                <input type="text" name="address" required>
            </div>
            <button class="btn btn-secondary btn-block" type="submit">購入する</button>
        </form>
        </div>
    </div>
</div>

@endsection