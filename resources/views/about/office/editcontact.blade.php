@extends('appforaboutoffice')

@section('content')

<section class="container">
	<form action="{{ url('about/office/aboutoffice/'.$query->id) }}" method="post">
		<font face="monospace" size="5">聯絡方式</font>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		<input type="text" name="content" class="form-control" value="{{ $query->content }}" required="required">
		<br>
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