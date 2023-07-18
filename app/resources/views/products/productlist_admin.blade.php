<!-- 全ユーザー商品リスト -->
@extends('layouts.app')

@section('content')
<p>管理者ページ</p>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">商品ID</th>
      <th scope="col">商品名</th>
      <th scope="col">出品停止</th>
    </tr>
  </thead>
  <tbody>
  @foreach($product_lists as $product_list)   
    <tr>
      <!-- <th scope="row">1</th> -->
      <td>{{ $product_list->id }}</td>
      <td>{{ $product_list->name }}</td>
      @if($product_list['product_flg']==0) <!--0だったら利用停止を表示 -->
      <td><a href="{{ route('product.stop',['id'=>$product_list->id]) }}" class="btn btn-secondary btn-lg">出品停止</a></td>
      @else
      <td><a href="{{ route('product.start',['id'=>$product_list->id]) }}" class="btn btn-secondary btn-lg">出品再開</a></td>
      @endif
    </tr>
  @endforeach
  </tbody>
</table>
@endsection