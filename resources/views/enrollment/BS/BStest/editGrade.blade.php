@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BStest/'.$query->id) }}" method="post">
		<font face="monospace" size="5">學年</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="year" class="form-control" value="{{ $query->year }}" required="required" placeholder="請輸入文字，例: 107學年"><br>
		<font face="monospace" size="5">最低錄取分數</font>
		<input type="text" name="grade" class="form-control" value="{{ $query->grade }}" required="required" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)"  placeholder="請輸入數字"><br>
		<font face="monospace" size="5">招收人數</font>
		<input type="text" name="num" class="form-control" value="{{ $query->num }}" required="required" placeholder="請輸入文字，例: 收42人"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
<script>
    function ValidateNumber(e, pnumber)
	{
    	if (!/^\d+[.]?\d*$/.test(pnumber))
    	{
      		e.value = /^\d+[.]?\d*/.exec(e.value);
    	}
    	return false;
	}
</script>