@extends('app')

@section('css')
<!-- 放css -->
@stop

@section('content')

<section class="container">
	<form action="{{ url('honor') }}" method="post">
		<font face="monospace" size="5">標題</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="title" class="form-control"><br>
	    <input type="submit" value="送出" class="btn btn-primary">
	</form>	

</section>

@stop

@section('js')
<!-- 放js -->
@stop
