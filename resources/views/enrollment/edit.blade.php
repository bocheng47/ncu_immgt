@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/'.$edit_post->id) }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<font face="monospace" size="5">標題</font>
		<input type="text" name="title" class="form-control" value="{{ $edit_post->title }}" placeholder="請輸入文字" required="required"><br>
		<font face="monospace" size="5">學制</font>
		<input type="text" name="degree" class="form-control" value="{{ $edit_post->degree }}" placeholder="請輸入文字" required="required"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop

