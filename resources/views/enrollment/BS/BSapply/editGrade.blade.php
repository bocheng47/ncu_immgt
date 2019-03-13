@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BSapply/'.$BSapply_Grade->id.'/updateText') }}" method="post">
		<font face="monospace" size="5">學年度</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="year2" class="form-control" value="{{ $BSapply_Grade->year2 }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		<font face="monospace" size="5">最低錄取級分</font>
		<input type="text" name="low" class="form-control" value="{{ $BSapply_Grade->low }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		<font face="monospace" size="5">最高錄取級分</font>
		<input type="text" name="high" class="form-control" value="{{ $BSapply_Grade->high }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required"><br>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
<script>
    function ValidateNumber(e, pnumber)
    {
      if (!/^\d+$/.test(pnumber))
      {
        e.value = /^\d+/.exec(e.value);
      }
      return false;
    }
  </script>