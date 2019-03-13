@extends('enrollment_layout')

@section('content')

<section class="container">
	<form action="{{ url('enrollment/BS/BStest/'.$query->id) }}" method="post">
		<font face="monospace" size="5">考科</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="subject" class="form-control" value="{{ $query->subject }}" required="required" placeholder="請輸入文字">
		<font face="monospace" size="5">加權</font>
		<input type="text" name="weight" class="form-control" value="{{ $query->weight }}" required="required" placeholder="請輸入文字，例: x2.00">
		<font face="monospace" size="5">同分參酌順序</font>
		<input type="text" name="order" class="form-control" value="{{ $query->order }}" placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" required="required">
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