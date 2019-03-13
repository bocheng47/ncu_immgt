@extends('appforaboutoffice')

@section('content')

<section class="container">
	<form action="{{ url('about/office/aboutoffice') }}" method="post">
		  {{ csrf_field() }}
		<font face="monospace" size="5">聯絡方式:</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}" required="required">
		<input type="text" name="content" class="form-control">
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
