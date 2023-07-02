@extends('layouts.app')

@section('content')
<div class="card-body">
    <input type="text">
    <button type="submit" class="btn btn-warning">検索する</button>
    <button type="submit" class="btn btn-danger">出品する</button>
    <button type="submit" class="btn btn-outline-danger">出品一覧</button>
</div>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col">
        <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">商品１</h5>
                <p class="card-text">¥000</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">商品２</h5>
                <p class="card-text">¥000</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">商品３</h5>
                <p class="card-text">¥000</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">商品４</h5>
                <p class="card-text">¥000</p>
            </div>
        </div>
    </div>
</div>

@endsection