@extends('appforaboutstatistics')

@section('content')

<section class="container">
	<form action="{{ url('about/statistics/aboutstatistics') }}" method="post">
		@csrf
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		學年:
			<input type="text" name="year" class="form-control" id="year" style="width:200px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		大學部：
		<br>
			男<input name="menofyearcollege" class="form-control" id="menofyearcollege" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
            女<input name="womenofyearcollege" class="form-control" id="womenofyearcollege" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
        博士班：
        <br>
        	男<input name="menofyearphd" class="form-control" id="menofyearphd" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
            女<input name="womenofyearphd" class="form-control" id="womenofyearphd" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
        碩士在職專班：
        <br>
        	男<input name="menofyearemba" class="form-control" id="menofyearemba" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
            女<input name="womenofyearemba" class="form-control" id="womenofyearemba" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
		碩士班：
		<br>
			男<input name="menofyearms" class="form-control" id="menofyearms" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
            女<input name="womenofyearms" class="form-control" id="womenofyearms" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
        <br>
        <input type=submit value="新增" class="btn btn-primary">
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