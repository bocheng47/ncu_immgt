@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->

<section class="container"><br>
    {{-- if the user's been authenticated --}}
    @php($auth = false)
    	@auth
    		@if( (Auth::user()->usertype == 0) )
    			@php($auth = true)
    		@endif
    	@endauth
    {{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}

	@include('enrollment/vnavbar')

	<div class="row">

    	<div class="col-sm-1"></div>

    	<div class="col-sm-9"><br>

			<div id="maincontent">
                
                @if($auth)
                <a href="{{ url('enrollment/BS/BStest/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif
            	<h3>考科與加權</h3>
                

            	<table class="table">
                	<thead>
                    	<tr>
                        	<td>考科</td>
          	              	<td>考科加權</td>
                    	</tr>
                	</thead>


                    <tbody>
                        @foreach($BStest_Sub as $sub)
                            <tr>
                                <td>{{ $sub->subject }}</td>
                                <td>{{ $sub->weight }}</td>
                                @if($auth)
                                <td><a href="{{ url('enrollment/BS/BStest/'.$sub->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                                <td>
                                    <form action="{{ url('enrollment/BS/BStest/'.$sub->id) }}" method="post">
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

            	<h3>同分參酌順序</h3>
            	
            	<table class="table">

                	<tbody>
                        @foreach($BStest_Sub as $sub)
                            <tr>
                                <td>{{ $sub->order }}</td>
                                <td>{{ $sub->subject }}</td>
                            </tr>
                        @endforeach
                	</tbody>
            	</table>
                @if($auth)
                <a href="{{ url('enrollment/BS/BStest/createGrade') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif
            	<h3>歷年指考入學錄取最低分數</h3>
                
            	<table class="table">
                	<thead>
                    	<tr>
                        	<td>學年</td>
                        	<td>最低錄取分數</td>
                        	<td>招收人數</td>
                    	</tr>
                	</thead>
                	<tbody>
                        @foreach($BStest_Grade as $grade)
                            <tr>
                                <td>{{ $grade->year }}</td>
                                <td>{{ $grade->grade }}</td>
                                <td>{{ $grade->num }}</td>
                                @if($auth)
                                <td><a href="{{ url('enrollment/BS/BStest/'.$grade->id.'/editGrade') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                                <td>
                                    <form action="{{ url('enrollment/BS/BStest/'.$grade->id) }}" method="post">
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
    <div class="col-sm-4"></div>

</section>
@endsection 

@section('js')
<!-- 放js -->

@stop