@extends('layouts.layout') 
@section('title', '聯絡系辦')
@section('css')
<style>
@import "compass/css3";
.content-table {
  font-family: 'Arial';
 /* margin: 25px auto;*/
  border-collapse: collapse;
  border: 1px solid #eee;
  border-bottom: 2px solid #4760bb;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
}
.content-table tbody tr:hover {
  background: #f4f4f4;
  cursor: pointer;
}
.content-table tr:hover td {
  color: #555;
}

.content-table tr.active
{
  background-color: #E6E6FA;
}

.content-table th, .content-table td {
  color: #999;
  border: 1px solid #eee;
  padding: 12px 35px;
  border-collapse: collapse;
}

.content-table td {
  padding: 12px 20px;
}

.content-table th {
  background: #4760bb;
  color: #fff;
  text-transform: uppercase;
  font-size: 12px;
}
.content-table th.last {
  border-right: none;
} 
.title{
	font-size:17px;
	font-weight: bold;
}
.modal-backdrop{display: none;}
.content_title{
	font-size:20px;
    color:#3261e1;
}

.link{
    border-radius: 5px;
    font-size: 15px;
}

.link:link {
    color: #3261e1;
    font-size: 15px;
}
.link:visited {
    color: #3261e1;
    font-size: 15px;
}
.link:hover {
    text-decoration: underline;
    /*background-color: #eeeeee;*/
    font-weight: bold;
    
}
.link:active {
    background-color: #eeeeee;
}

.sidebar_title{
    font-size: 15px;
    background-color: #3152c7;
    color: white;
    text-align: center;
    vertical-align: middle;
    /*border-radius: 5px;*/
}

.sidebar_link
{
    text-align: left;
    padding-left: 15px;
    padding-top: 5px;
}
</style>
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->
<html>
{{-- if the user's been authenticated --}}
@php($auth = false)
	@auth
		@if( (Auth::user()->usertype == 0) )
			@php($auth = true)
		@endif
	@endauth
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
<div class="container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-2" style="padding-top: 30px; font-family: 微軟正黑體;">
			<div>
				<ul>
					<li class="sidebar_link"><a class="link" href="{{ url('/about')}}"><span class="fa fa-university"></span> 系所介紹</a></li>
					<li class="sidebar_link"><a class="link" href="{{ url('/about/office/aboutoffice')}}"><span class="fa fa-suitcase" aria-hidden="true"></span> 聯絡系辦</a></li>
					<li class="sidebar_link"><a class="link" href="{{ url('/about/statistics/aboutstatistics')}}"><span class="fa fa-graduation-cap" aria-hidden="true"></span> 畢業統計</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="insidebox">
				{{--系辦聯繫方式table--}}
				<table class="table">
					@if($auth)
					<a href="{{ url('about/office/createcontact') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
					@endif
					<tbody>
						<div class='content_title'>
							<i class="fa fa-commenting-o" aria-hidden="true"></i>
							<b>系辦聯繫方式</b>
							<br>
						</div>
						<tr>
							<th>聯絡方式</th>
							@if($auth)
							<th>編輯</th>
							<th>刪除</th>							
							@endif
						</tr>
						@foreach ($query as $contact)
			                <tr>
			                    <td>{{ $contact->content }}</td>
			                    @if($auth)
			                    <td>
									<a href="{{ url('about/office/aboutoffice/'.$contact->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a>
			                    </td>
			                    <td>
                					<form action="{{ url('about/office/aboutoffice/'.$contact->id) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onclick="return confirm('確定要刪除嗎?');">
                                    </form>
	           					</td> 
	           					@endif
            				</tr>
            			@endforeach
					</tbody>
				</table>
				<br>
				{{--資管系辦公室人員table--}}
				<div class="content_title">
					<i class="fa fa-street-view" aria-hidden="true"></i>	
					<b>資管系辦公室人員</b>
					<br>
				</div>
				<table class="table">
					@if($auth)
					<a href="{{ url('about/office/createstaff') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
					@endif
					<tr>
						<th>職稱</th>
						<th>姓名</th>
						<th>email</th>
						@if($auth)
						<th>排序</th>
						<th>編輯</th>
						<th>刪除</th>
						@endif
					</tr>
					<tbody>
            			@foreach ($query2 as $staff)
            			@if($staff->jobtitle != null)
			                <tr>
			                    <td>{{ $staff->jobtitle }}</td>
			                    <td>{{ $staff->name }}</td>
			                    <td><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></td>
			                    @if($auth)
			                    <td>{{ $staff-> rank }}</td>
			                    <td>
			                    	<a href="{{ url('about/office/aboutoffice/'.$staff->id.'/editstaff') }}" role="btn" class="btn">編輯</a>
			                    </td>
			                    <td>
                					<form action="{{ url('about/office/aboutoffice/'.$staff->id) }}" method="post" >
                                  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  		<input type="hidden" name="_method" value="delete">
                                  		<input type="submit" role="btn" value="刪除" onclick="return confirm('確定要刪除嗎?');">
                              		</form>
	           					</td>
	           					@endif
            				</tr>
            			@endif
            			@endforeach
					</tbody>
				</table>
			</div> {{-- insidebox --}}
		</div> {{-- col-md-9 --}}
	</div> {{-- row --}}
</div> {{-- container --}}
<br><br><br><br><br><br><br><br>
</html>
@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript">
	 // CKEDITOR.replace('content');

	$('.modal').on('show.bs.modal', function() {
	  // prevent modal appear under background
	  $(this).appendTo("body");
	})
</script>
@stop
