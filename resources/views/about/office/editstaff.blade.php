@extends('appforaboutoffice')

@section('content')

<section class="container">
	<form action="{{ url('about/office/aboutoffice/'.$query2->id) }}" method="post">
		<font face="monospace" size="5">職稱:</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="jobtitle" class="form-control" value="{{ $query2->jobtitle }}" required="required">
		<font face="monospace" size="5">姓名:</font>
		<input type="text" name="name" class="form-control" value="{{ $query2->name }}" required="required">
		<font face="monospace" size="5">email:</font>
		<input type="email" name="email" class="form-control" value="{{ $query2->email }}"required="required">
		<font face="monospace" size="5">排序</font>
		<input type="text" name="rank" class="form-control"  value="{{ $query2->rank }}" required="required"placeholder="請輸入整數" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)">
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