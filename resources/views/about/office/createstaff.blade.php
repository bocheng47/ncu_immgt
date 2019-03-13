@extends('appforaboutoffice')

@section('content')

<section class="container">
	<form action="{{ url('about/office/aboutoffice') }}" method="post">
		<font face="monospace" size="5">職稱:</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="jobtitle" class="form-control" required="required">
		<font face="monospace" size="5">名字:</font>
		<input type="text" name="name" class="form-control" required="required">
		<font face="monospace" size="5">email:</font>
		<input type="email" name="email" class="form-control"required="required">
		<font face="monospace" size="5">排序</font>
		<input name="rank" class="form-control" placeholder="請輸入數字" required="required"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
