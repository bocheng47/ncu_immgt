@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BStest') }}" method="post">
		<font face="monospace" size="5">學年</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="year" class="form-control" required="required" placeholder="請輸入文字，例: 107學年">
		<font face="monospace" size="5">最低錄取分數</font>
		<input type="text" name="grade" class="form-control" required="required" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)"  placeholder="請輸入數字">
		<font face="monospace" size="5">人數</font>
		<input type="text" name="num" class="form-control" required="required" placeholder="請輸入文字，例: 收42人"><br>
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