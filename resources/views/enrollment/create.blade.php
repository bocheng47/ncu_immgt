@extends('enrollment_layout')

@section('css')
<!-- 放css -->
@stop

@section('content')

<section class="container">
	<form action="{{ url('enrollment') }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<font face="monospace" size="5">標題</font>
		<input type="text" name="title" class="form-control" placeholder="請輸入文字" required="required"><br>
		<font face="monospace" size="5">學制</font>
		<input type="text" name="degree" class="form-control" placeholder="請輸入文字" required="required"><br>
	    <input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop

@section('js')
<!-- 放js -->
@stop

