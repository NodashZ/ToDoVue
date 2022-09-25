@extends('layouts')
@section('title','ToDo一覧')
@section('content')
<todo-list></todo-list>

<!-- 

<div class="row">
  <div class="col-md-10 col-md-offset-2">
    @if(session('err_msg'))
    <p class="text-danger">
      {{session('err_msg')}}
    </p>
    @endif

  </div>
</div>

 -->

@endsection