@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BSapply/'.$BSapply_Num->id.'/updateText') }}" method="post">
		<font face="monospace" size="5">學年度</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="year" class="form-control" value="{{ $BSapply_Num->year }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		<font face="monospace" size="5">招生名額</font>
		<input type="text" name="quota" class="form-control" value="{{ $BSapply_Num->quota }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		<font face="monospace" size="5">報名人數</font>
		<input type="text" name="num" class="form-control" value="{{ $BSapply_Num->num }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		<font face="monospace" size="5">錄取率</font>
		<input type="text" name="rate" class="form-control" value="{{ $BSapply_Num->rate }}"><br>
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