@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BSsport/'.$BSsport_text->id) }}" method="post">
		<font face="monospace" size="5">甄選項目</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="subject" class="form-control" value="{{ $BSsport_text->subject }}" required="required" placeholder="請輸入文字"><br>
		<font face="monospace" size="5">性別</font>
		<input type="text" name="gender" class="form-control" value="{{ $BSsport_text->gender }}" required="required" placeholder="請輸入文字"><br>
		<font face="monospace" size="5">人數</font>
		<input type="text" name="num" class="form-control" value="{{ $BSsport_text->num }}" required="required" placeholder="例:1人"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
