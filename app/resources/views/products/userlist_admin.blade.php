@extends('layouts.app')

@section('content')
<p>管理者ページ</p>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ユーザーID</th>
      <th scope="col">ユーザー名</th>
      <th scope="col">利用停止</th>
    </tr>
  </thead>
  <tbody>
  @foreach($user_lists as $user_list)   
    <tr>
      <!-- <th scope="row">1</th> -->
      <td>{{ $user_list->id }}</td>
      <td>{{ $user_list->name }}</td>
      @if($user_list['user_flg']==0) <!--0だったら利用停止を表示 -->
      <td><a href="{{ route('user.stop',['id'=>$user_list->id]) }}" class="btn btn-secondary btn-lg">利用停止</a></td>
      @else
      <td><a href="{{ route('user.start',['id'=>$user_list->id]) }}" class="btn btn-secondary btn-lg">利用再開</a></td>
      @endif
    </tr>
  @endforeach
  </tbody>
</table>
@endsection