@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->
<style>
    .view{
      width:100%;
      height:700px;
    }
    @media screen and (max-width : 766px) {
    .view{
     text-align: center;
     width:350px;
    }
}
</style>
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
          @if($auth)
          <form method="post" action="{{ url('/enrollment/BS/BSstar') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
              <table class="table">
                  <tr>
                    <td width="40%" align="right"><label>選擇PDF上傳</label></td>
                    <td width="30"><input name="upload_file" type="file" id="upload_file" accept=".pdf"/></td>
                    <td width="30%" align="left"><input type="submit" name="picture" class="btn btn-primary" value="Upload"></td>
                  </tr>
                  <tr>
                    <td width="40%" align="right"></td>
                    <td width="30"><span class="text-muted">pdf</span></td>
                    <td width="30%" align="left"></td>
                  </tr>
              </table>
            </div>
          </form>

          @endif
          @foreach($BSstar_pdf as $pdf)
            <embed class="view" src ="{{ asset('enrollmentpdf/bsstar/' . $pdf->pdf_name) }}"></embed>
          @if($auth)
          <form action="{{ url('/enrollment/BS/BSstar/'.$pdf->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="delete">
            <input type="submit" role="btn" class="btn btn-primary" value="刪除" onClick="return confirm('確定要刪除嗎？');">
          </form>
          @endif
          <br>
          @endforeach
		   		<br />

		   		<h3>歷年錄取名額與錄取級分</h3>
                @if($auth)
                <a href="{{ url('enrollment/BS/BSstar/createNum') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif

            	<table class="table">
                	<thead>
                    	<tr>
                        	<td>學年度</td>
          	              	<td>招生名額</td>
          	              	<td>報名人數</td>
          	              	<td>錄取率</td>
          	              	<td>最低錄取級分</td>
          	              	<td>最高錄取級分</td>
                    	</tr>
                	</thead>

                    <tbody>
                        @foreach($BSstar_text as $text)
                            <tr>
                                <td>{{ $text->year }}</td>
                                <td>{{ $text->quota }}</td>
                                <td>{{ $text->num }}</td>
                                <td>{{ $text->rate }}</td>
                                <td>{{ $text->low }}</td>
                                <td>{{ $text->high }}</td>
                                @if($auth)
                                <td><a href="{{ url('enrollment/BS/BSstar/'.$text->id.'/editNum') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                                <td>
                                    <form action="{{ url('enrollment/BS/BSstar/'.$text->id.'/deleteText') }}" method="post">
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

<script type="text/javascript">
    function validateFileType(){
        var fileName = document.getElementById("fileName").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
        }   
    }
</script>

@stop