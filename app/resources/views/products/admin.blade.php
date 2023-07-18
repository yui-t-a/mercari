@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    管理者ページ
  </div>
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <a href="{{ route('admin.userlist') }}">
        <button type="button" class="btn btn-primary btn-lg">ユーザーリスト</button>
    </a>
    <a href="{{ route('admin.productlist') }}">
        <button type="button" class="btn btn-secondary btn-lg">出品商品リスト</button>
    </a>
  </div>
</div>
@endsection