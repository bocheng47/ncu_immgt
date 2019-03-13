@extends('layouts.layout') 
@section('title', '企業導師專區') 

@section('css')
<!-- 放css -->
<link rel="stylesheet" href="{{ URL::asset('/css/activity.css') }}">
<style>
#left_bar{
    padding-top: 30px;
    font-family: 微軟正黑體;
    padding-bottom: 50px;
}

#left_bar ul li{
    /*color: #3261e1;*/
    height: 30px;
    width: 100%;
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
    background-color: #eeeeee;
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
}

.sidebar_link
{
    text-align: left;
    padding-left: 15px;
    padding-top: 5px;
}
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
</style>
@stop

@section('content')
<!-- 主畫面 -->
<!-- .container --> 
 <div class="container">
    <!-- <div class="container-fluid "> -->
 <div class="row">

    <div class="col-sm-1"></div>

    <div class="col-sm-2" id="left_bar">
    <div>
      <ul>
        <li class="sidebar_title"><b>企業導師活動</b></li>
        <li class="sidebar_link"><a href="/business" class="link">&nbsp最新消息</a></li>
        <li class="sidebar_link"><a href="/business/activity" class="link">&nbsp活動目的</a></li>
        <li class="sidebar_link"><a href="/business/main" class="link">&nbsp主要內容</a></li>
        <hr>
        <li class="sidebar_title"><b>企業導師專區</b></li>
        <li class="sidebar_link"><a href="/business/teacher" class="link">&nbsp歷屆企業導師名單</a></li>
        <li class="sidebar_link"><a href="/business/strategy" class="link">&nbsp企業導師角色</a></li>
        <hr>
        <li class="sidebar_title"><b>學生專區</b></li>
        <li class="sidebar_link"><a href="/business/student" class="link">&nbsp學生角色</a></li>
        <li class="sidebar_link"><a href="https://www.facebook.com/groups/430606330310904"  target="_blank" class="link">&nbspFacebook社團</a></li>
      </ul>
    </div>
  </div>

    <!-- <div class="col-sm-2">
         <div id="system_block">
          <table>
            <tr>
              <div align="center" style="background-color: #d1dcfb; font-family: 微軟正黑體 ;font-size:20px;"><b>企業導師活動</b></div>
            </tr>
            <tr>
              <ul style="padding-left: 10%">
                <li><a href="/business" style="font-family: 微軟正黑體;font-size:16px;">&nbsp&nbsp最新消息</a></li>
                <li><a href="/business/activity" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbsp活動目的</a></li>
                <li><a href="/business/main" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbsp主要內容</a></li>
              </ul>
            </tr>
            <tr>
              <div align="center" style="background-color: #d1dcfb; font-family: 微軟正黑體;font-size:20px;" ><b>企業導師專區</b></div>
            </tr>
            <tr>
              <ul style="padding-left: 10%">
                <li><a href="/business/teacher" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbsp歷屆企業導師名單</a></li>
                <li><a href="/business/strategy" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbsp企業導師角色</a></li>
              </ul>
            </tr>
            <tr>
              <div align="center" style="background-color: #d1dcfb; font-family: 微軟正黑體 ;font-size:20px;" ><b>學生專區</b></div>
            </tr>
            <tr>
              <ul style="padding-left: 10%">
                <li><a href="/business/student" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbsp學生的角色</a></li>
                <li><a target="_blank" href="http://www.facebook.com/groups/430606330310904" style="font-family: 微軟正黑體;font-size:16px;"> &nbsp&nbspFacebook社團</a></li>
              </ul>
            </tr>            
          </table>
          <br>
        </div>
    </div> -->
        <div class="col-sm-8" style="padding-top: 30px; padding-bottom: 50px;">
            @php($auth = false)
        @auth
          @if( (Auth::user()->usertype == 0) )
            @php($auth = true)
          @endif
        @endauth
        {{-- 0 = 系辦帳號 --}}
        
        @if(session()->has('success'))
          <br>
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
            <div align="right">
                            @if($auth)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#YourModal" id="new_button" ><span class="glyphicon  glyphicon-plus">新增</span></button>
                            @endif
{{--                             <a href="/business" > &nbsp&nbsp首頁</a> --}}
            </div>
            <div id="title" style="font-family: 微軟正黑體; padding: 20px; font-size: xx-large;"><b><span class ="glyphicon glyphicon-tags"></span>  企業導師最新消息</b></div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th scope="col" style="font-family: 微軟正黑體;">時間</th>
                        <th scope="col" style="font-family: 微軟正黑體;">標題</th>
                        @if($auth)
                        <th scope="col" style="font-family: 微軟正黑體;"></th>
                        <th scope="col" style="font-family: 微軟正黑體;"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($businesses as $business)
                <tr>
                    <td>{{ $business->time }}</td>
                    <td><a href="{{ url('business/'.$business->id.'/post') }}"><span style="color:#4F4F4F;" >{{ $business->title }}</span></a></td>
                    @if($auth)
                    <td><form action="{{ url('business/'.$business->id) }}" method="GET">
                              <button type="button" class="edit_button" data-toggle="modal" data-target="{{"#editModal".$business->id}}"
                                id="edit-business-{{$business->id}}">編輯</button> 
                        </form></td>

                    <td><form action="{{ url('business/'.$business->id) }}" method="post" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">
                        <input type="submit" role="btn" class="delete-button" value="刪除" onClick="return confirm('確認要刪除？')">
                    </form></td>
                    @endif
                                        
                <!-- YourModal -->
                          @if($auth)
                          <td><div id="{{"editModal".$business->id}}" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <!-- YourModal content-->
                                  <div class="modal-content">                                                    
                                      <div class="modal-header">
                                          <table>
                                              <tr>
                                                  <td>
                                                      <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">編輯資料</h5>
                                                  </td>
                                                      <td style="width: 500px">
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close1">
                                                          <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </td>
                                                  </tr>
                                          </table>
                                      </div>
                                      <div class="modal-body">
                                          <form action="{{ url('business/'.$business->id) }}" method="post" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                          {{ method_field('PATCH') }}
                                                  <div>
                                                      <div style="padding-right: 50px "  required="required">時間</div>
                                                      <input class="add_bar" name='time' type="date" value="{{ $business->time }}">
                                                  </div>
                                                  <div>
                                                      <div style="padding-right: 50px " required="required">標題</div>
                                                      <input class="add_bar" name='title' value="{{ $business->title }}">
                                                  </div> 
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          <input type="submit" value="送出" class="btn btn-primary" >
                                                  </div>
                                              
                                          </form>
                                      </div>
                                  </div>   
                              </div>
                    </div></td>
                    @endif 
                    </tr>      
                @endforeach
                </tbody>
            </table>

        </div>

        {{-- <div class="col-sm-2"></div> --}}

    </div>
<div id="YourModal" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- YourModal content-->
                        <div class="modal-content">
                            <form action="{{ url('business') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-header">
                                    
                                    <h5 class="modal-title" id="newModalLabel" align="center">新的資料</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            
                                            <div style="text-align: center;">
                                                <h4 class="modal-title" id="modal-title">基本資料</h4>
                                            </div>
                                </div>        
                        <div class="modal-body">
                            <table align="center" id="add_table">
                                <div>
                                    <div style="padding-right: 50px ">時間</div>
                                        <input class="add_bar" name='time' required="required" type="date">
                                </div>
                                <div>
                                    <div style="padding-right: 50px " >標題</div>
                                    <input class="add_bar" name='title' required="required">
                                </div>
                                
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <input type="submit" value="送出" class="btn btn-primary" >
                                        </div>
                            </table>
                        </div>  
                            </form>
                        </div>
                    </div>
                </div>
               <div align="center" id="page">
               {{ $businesses->links() }}
               </div>
             <!-- </div> -->
           </div>
@endsection 

@section('js')
<!-- 放js -->
@stop
