@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->
<style>
    .view{
      width:100%;
      height:1000px;
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
  {{-- if the user's been authenticated --}}
  @php($auth = false)
    @auth
      @if( (Auth::user()->usertype == 0) )
        @php($auth = true)
      @endif
    @endauth
  {{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
  <section class="container"><br>
    @include('enrollment/vnavbar')
    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-9"><br>

      <div id="maincontent">
        @if($auth)
        <form method="post" action="{{ url('/enrollment/PhD/PhDexam') }}" enctype="multipart/form-data">
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
          @foreach($PhDexam as $pdf)
          <embed class="view" src ="{{ asset('enrollmentpdf/phdexam/' . $pdf->pdf_name) }}"></embed>
          @if($auth)
          <form action="{{ url('/enrollment/PhD/PhDexam/'.$pdf->id) }}" method="post">
          {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="delete">
                    <input type="submit" role="btn" class="btn btn-primary" value="刪除" onClick="return confirm('確定要刪除嗎？');">
        </form>
        @endif
        <br>
          @endforeach
        </div>
        <br>
            <p style="font-size: 13px">最新資訊請至<a href="http://pdc.adm.ncu.edu.tw/adm_index.asp?roadno=62" style="text-decoration:none;" target="_blank">本校招生組</a>查詢</p>
        
    </div>
      <div class="col-sm-2"></div>
  </section>
@endsection 

@section('js')
<!-- 放js -->
@stop