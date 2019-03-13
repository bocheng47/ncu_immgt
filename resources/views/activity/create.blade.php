@extends('layouts.layout') 
@section('title', '活動剪影') 

@section('css')
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->
<!-- .container -->
<!--   <div class="container">
  <div class="row">

    <div class="col-sm-1"></div>

    <div class="col-sm-3">
        <div class="title">活動剪影</div>
        <a class="bigLink" style="margin-top: 4px;" href="{{ url('/activity') }}">相簿分類</a>
        <hr>
        <ul><a href="{{ url('/activity') }}">大學部</a></ul>
        <hr> 
        <hr>
        <ul><a href="{{ url('/activity') }}">碩博士班</a></ul>
        <hr> 
        <hr>
        <ul><a href="{{ url('/activity') }}">在職專班</a></ul>
        <hr> 
        <hr>
        <ul><a href="{{ url('/activity') }}">其他</a></ul>
        <hr> 
    </div>

   <div class="col-sm-6">
        <div class="container">
			<form action="{{ url('activity') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="title" class="form-control">
				<input type="file" class="form-control" id="user_icon_file" name="user_icon_file" placeholder="上傳圖片" value="">
				<textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
				<input type="submit" value="送出" class="btn btn-primary">
			</form>	
        </div>
    </div>
    <div class="col-sm-2"></div>
  </div>
</div> -->

@endsection 

@section('js')
<!-- 放js -->
@stop
