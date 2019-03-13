@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->

@stop

@section('content')
<!-- 主畫面 -->
<!DOCTYPE html>
<html>
    {{-- if the user's been authenticated --}}
    @php($auth = false)
    	@auth
    		@if( (Auth::user()->usertype == 0) )
    			@php($auth = true)
    		@endif
    	@endauth
    {{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
 	<head>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	</head>
 	<body>
  	<br />
  	<section class="container"><br>
		@include('enrollment/vnavbar')
		<div class="row">

    	<div class="col-sm-1"></div>

    	<div class="col-sm-9"><br>

			<div id="maincontent">

		   		<h3>高中職運動成績優良之學生甄選項目與甄選人數</h3>
                @if($auth)
                <a href="{{ url('enrollment/BS/BSsport/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif

            	<table class="table">
                	<thead>
                    	<tr>
                        	<td>甄選項目</td>
          	              	<td>性別</td>
          	              	<td>人數</td>
                    	</tr>
                	</thead>

                    <tbody>
                        @foreach($BSsport_text as $text)
                            <tr>
                                <td>{{ $text->subject }}</td>
                                <td>{{ $text->gender }}</td>
                                <td>{{ $text->num }}</td>
                                @if($auth)
                                <td><a href="{{ url('enrollment/BS/BSsport/'.$text->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                                <td>
                                    <form action="{{ url('enrollment/BS/BSsport/'.$text->id) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onClick="return confirm('確定要刪除嗎？');">
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
            	</table>

				<br>
				<p style="font-size: 13px">最新資訊請至<a href="http://pdc.adm.ncu.edu.tw/adm_index.asp?roadno=62" style="text-decoration:none;" target="_blank">本校招生組</a>查詢</p>              

		  	</div>
		</div>
    	<div class="col-sm-2"></div>
	</section>
	</body>
</html>

@endsection 

@section('js')
<!-- 放js -->
@stop