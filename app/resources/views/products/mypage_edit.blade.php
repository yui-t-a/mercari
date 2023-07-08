@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="col-md-8">
    <h4 class='text-center'>プロフィール編集</h4>
    </div>
    <!-- route()内にURLに入れるパラメーターを渡す -->
    <form action="{{ route('mypage.store',['mypage' => Auth::id()])}}" method="post" enctype="multipart/form-data">
    <!--@method('PATCH')     rootlistに書いているMethodの内容を記述 -->
    @csrf
    <div class="d-flex flex-row">
    <div class="card">         
        <div class="mb-3">
            <!-- product_idが選択した商品のものを表示させる     -->
        <img src="" class="card-img-top" alt="アイコン画像"> 
                <label for="image_file_name" class="form-label">画像を変更する</label>
                <input type="file" class="form-control-file" name="image_file_name">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">紹介文</label>
                <input type="text" class="form-control" name="comment" value="">
            </div>
            
            <button type="submit" class="btn btn-danger">変更する</button>
        
    </div>
    
    </div>
    </form>
    
</div>


@endsection