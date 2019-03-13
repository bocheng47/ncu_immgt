@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->

@stop

@section('content')
<!-- 主畫面 -->
<section class="container"><br>

	@include('enrollment/vnavbar')

	<div class="row">

    	<div class="col-sm-1"></div>

    	<div class="col-sm-9"><br>

			<div id="maincontent">

                <span style="font-size:26px; color:red;">目前尚未開放！</span>
				<br><br><br><br><br><br>

			</div>

    	<div class="col-sm-2"></div>

    </div>

</section>
@endsection 

@section('js')
<!-- 放js -->
@stop