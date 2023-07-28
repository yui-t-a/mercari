@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

    <h5 class='text-center mb-5'>プロフィール編集</h5>
    
    <!-- route()内にURLに入れるパラメーターを渡す -->
    <form action="{{ route('mypage.store',['mypage' => Auth::id()])}}" method="post" enctype="multipart/form-data">
    <!--@method('PATCH')     rootlistに書いているMethodの内容を記述 -->
    @csrf
    <div class="row justify-content-center">
          
        <div class="mb-5">
            
            <!-- <img src="" class="card-img-top" alt="アイコン画像">  -->
                <label for="image_file_name" class="form-label">画像を変更する</label>
                <input type="file" class="form-control-file" name="image_file_name">
        </div>
        <div class="mb-5">
            <label for="comment" class="form-label text-center">紹介文</label>
            <input type="text" class="form-control" name="comment" value="{{ $user['comment']}}" required>
        </div>
            
            <button type="submit" class="btn btn-danger" style="width:54vw;">変更する</button>
        
    
    
    </div>
    </form>
    </div>
    
</div>
</div>


@endsection