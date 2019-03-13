@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BSsport') }}" method="post">
		<font face="monospace" size="5">甄選項目</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="subject" class="form-control" required="required" placeholder="請輸入文字"><br>
		<font face="monospace" size="5">性別</font>
		<input type="text" name="gender" class="form-control" required="required" placeholder="請輸入文字"><br>
		<font face="monospace" size="5">人數</font>
		<input type="text" name="num" class="form-control" required="required" placeholder="請輸入文字，例:1人"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
