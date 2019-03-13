@extends('appforaboutstatistics') 
@section('content')
<!-- 主畫面 -->
<section class="container">
	<form action="{{ url('about/statistics/aboutstatistics/'.$query->id )}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		@csrf
		學年:
			<input type="text" name="year" class="form-control" id="year" value="{{ $query->year }}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
		大學部：<br>
				男:<input type="text" name="menofyearcollege" class="form-control" value="{{ $query->menofyearcollege }}" style="width:100px;height:30px;"placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
				女:<input type="text" name="womenofyearcollege" class="form-control" value="{{ $query->womenofyearcollege }}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
		博士班：<br>
				男:<input type="text" name="menofyearphd" class="form-control" value="{{ $query->menofyearphd }}" style="width:100px;height:30px;"placeholder="請輸入整數"  style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
				女:<input type="text" name="womenofyearphd" class="form-control" value="{{ $query->womenofyearphd }}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)"> 
		碩士在職專班：<br>
				男:<input type="text" name="menofyearemba" class="form-control" value="{{ $query->menofyearemba}}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
				女:<input type="text" name="womenofyearemba" class="form-control" value="{{ $query->womenofyearemba }}" style="width:100px;height:30px;"placeholder="請輸入整數"  style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)"> 
		碩士班：<br>
				男:<input type="text" name="menofyearms" class="form-control" value="{{ $query->menofyearms }}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
				女:<input type="text" name="womenofyearms" class="form-control" value="{{ $query->womenofyearms }}" style="width:100px;height:30px;" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
		<input type=submit value="送出" class="btn btn-primary">
	</form>
</section>
@endsection 

@section('js')
<!-- 放js -->
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