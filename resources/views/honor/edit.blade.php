@extends('honor_layout')

@section('content')

<section class="container">
	<form action="{{ url('honor/'.$honor_post->id) }}" method="post">
		<font face="monospace" size="5">標題</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="title" class="form-control" value="{{ $honor_post->title }}"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop