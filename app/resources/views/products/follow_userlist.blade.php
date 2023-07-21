<!-- フォローしたユーザーの一覧ページ -->
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 class='text-center'>フォローユーザー</h4>
        <div class="col d-flex flex-wrap">
            @foreach($users as $user)   
            
            <a href="{{ route('other.user',['id' => $user->id])}}">
                <div class="card" style="width: 18rem;">
                    @if(isset($user->image_file_name))
                    <img src="{{ asset('storage/profile/'.Auth::user()->image_file_name)}}" class="card-img-top" alt="アイコン画像">
                    @else
                    <img src="{{ asset('storage/profile/noimage.png')}}" class="card-img-top" alt="noimage">
                    @endif
                    <div class="card-body">
                        <h5 class="text-center">{{ $user->name}}</h5>
                    </div>
                </div>
            </a>   
            

            @endforeach
        </div>
    </div>
</div>
@endsection    