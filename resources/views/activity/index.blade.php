@extends('layouts.layout') 
@section('title', '活動剪影') 

@section('css')
 <!-- 放css --> 
<link rel="stylesheet" href="{{ URL::asset('/css/activity.css') }}">
<style>
.activiy-table{
    padding:10px;
    border-width:2px;
    border-style:solid;
    border-color:#96c2f1;
}
td{
    width:317px;
}
#left_bar{
    padding-top: 30px;
    font-family: 微軟正黑體;
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

</style>
@stop


@section('content')
<!-- 主畫面 -->
<div class="container">
  <div class="row">

    <!-- <div class="col-sm-1"></div> -->
    
    <div class="col-sm-2" id="left_bar">
         <div>
              <ul>
                <li class="sidebar_title" ><b>相簿分類</b></li>
                <li class="sidebar_link"><span class ="glyphicon glyphicon-education"></span><a href="/activity/showall/bachelor" class="link">大學部</a></li>
                <li class="sidebar_link"><span class ="glyphicon glyphicon-education"></span><a href="/activity/showall/master" class="link" >碩博士生</a></li>
                <li class="sidebar_link"><span class ="glyphicon glyphicon-education"></span><a href="/activity/showall/emba" class="link" >在職專班</a></li>
                <li class="sidebar_link"><span class ="glyphicon glyphicon-education"></span><a href="/activity/showall/other" class="link" >其他</a></li>
              </ul>
        </div>
    </div>
    <!-- 啟動modal -->
    
    <div class="col-sm-8">
                        {{-- if the user's been authenticated --}}
                        @php($auth = false)
                          @auth
                            @if( (Auth::user()->usertype == 0) )
                              @php($auth = true)
                            @endif
                          @endauth
                        {{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
                        @if (count($errors) > 0)
                           <div class="alert alert-danger" id="errordiv">
                            {!! implode('<br>', $errors->all()) !!}
                           </div>
                        @endif
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
{{--                             <a href="/activity" > &nbsp&nbsp活動剪影</a> --}}
                        </div>
                  @foreach($activities as $activity)
                  <div class = modal-new >
                      <table class="table table-striped table-dark activiy-table" align="right" width="50%" >                           
                          <tr>
                            <td>
                              <div class ="an" style=" font-weight :bold; font-family: 微軟正黑體;font-size:20px;">
                                  <span class ="glyphicon glyphicon-book"></span>
                                  {{ $activity->activityname }}
                              </div>
                            </td>
                            <td>
                            </td>  
                          </tr>
                          <tr>
                            <td>  
                              <div>
                              <img class="a_img" src="{{ asset('img/activity/'.$activity->id.'/'.$activity->picture) }}" width="210" height="156">
                              </div>
                            </td>
                            <td>
                               <div align="left"> {!! $activity->introduce !!} </div>
                            </td>
                          </tr>
                           <tr>
                              <td>    
                              @if($auth)
                              <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="{{"#addModal".$activity->id}}" id="add_button" ><span class="glyphicon  glyphicon-plus">加相片</span></button>
                                    
                              
                              <form action="{{ url('activity/'.$activity->id) }}" method="GET">
                              <button type="button" class="edit_button" data-toggle="modal" data-target="{{"#editModal".$activity->id}}"
                                id="edit-activity-{{$activity->id}}">編輯</button> 
                              </form>
                                        

                              <form action="{{ url('activity/delete/'.$activity->id) }}" method="post" >
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="_method" value="delete">
                                  <input type="submit" role="btn" class="delete-button" value="刪除" onClick="return confirm('確定要刪除嗎？');">
                              </form>
                           @endif
                           <td>
                           </td>
                           </tr>
                           <tr>
                          <td>
                          </td> 
                           <td>   
                              <div class ="more" align="right">    
                                  <a href="{{ url('activity/show/'.$activity->id) }}"> &nbsp&nbsp更多</a> 
                              </div> 
                           </td>        
                          </tr>
                      </table>
                    </div>
          
                          <div id="{{"addModal".$activity->id}}" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <!-- YourModal content-->
                                  <div class="modal-content">                                                    
                                      <div class="modal-header">
                                          <table>
                                              <tr>
                                                  <td>
                                                      <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">加照片(限英文數字檔名)</h5>
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
                                          <form action="{{ url('activity/'.$activity->id) }}" method="post" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                          {{ method_field('PUT') }}

                                                              <table align="center" id="add_table">
                                                                  <tr>
                                                                    <input type="file" id="progressbarTWInput" name = "picture[]" accept="image/*" / multiple="multiple" required="required">   
                                                                  </tr>
                                                              </table>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          <input type="submit" value="送出" class="btn btn-primary">
                                                  </div>   
                                          </form>
                                      </div>
                                  </div>   
                              </div>
                          </div>
                          
                          

                          <!-- YourModal -->
                          <div id="{{"editModal".$activity->id}}" class="modal fade  activity-edit-modal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <form action="{{ url('activity/'.$activity->id) }}" id="activity-form-edit" method="post" enctype="multipart/form-data">
                                          {{ csrf_field() }}
                                          {{ method_field('PATCH') }}
                                              <table align="center" id="add_table">
                                                  <div class = "modal-body-body">   
                                                      <br>        
                                                          <div style="padding-left: 50px"><h3><b>相簿資訊</b></h3></div>
                                                              <tr>
                                                                  <td style="padding-right: 50px " required="required">活動名稱</td>
                                                                      <td>
                                                                          <input class="add_bar" name='activityname' value="{{ $activity->activityname}}" required="required">
                                                                      </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td style="padding-right: 50px " required="required">活動簡介</td>
                                                                    <td>
                                                                      <textarea class="add_word" name='introduce' id="introduce-edit"> {{ $activity->introduce }} </textarea> 
                                                                    </td>  
                                                                  </tr>
                                                                  <tr>
                                                                     <td>創建時間</td>
                                                                     <td>
                                                                        <input class="add_time" name="time" type="date" value="{{ $activity->time}}" required="required">
                                                                    </td>
                                                                  </tr>     
                                                                  <tr>
                                                                      <td style="vertical-align: top">分類</td>
                                                                  </tr>
                                        
                                                                  <tr>
                                                                      <td>
                                                                          <input type="radio" name="class" value="0" {{ $activity->class=="0" ? "checked" : " " }}>大學部<br>
                                                                          <input type="radio" name="class" value="1" {{ $activity->class=="1" ? "checked" : " " }}>碩博士班<br>
                                                                          <input type="radio" name="class" value="2" {{ $activity->class=="2" ? "checked" : " " }}>在職專班<br>
                                                                          <input type="radio" name="class" value="3" {{ $activity->class=="3" ? "checked" : " " }}>其他<br>
                                                                      </td>
                                                                  </tr>
                                                                  </table>
                                                                  <table align="center" id="pic_table">
                                                                  <tr>
                                                                  <td>
                                                                  <div class="addpic">上傳</div>
                                                                  <input type="file" id="progressbarTWInput" name = "picture" accept="image/*" / required="required">
                                                                  </td>    
                                                                  </tr>
                                                  </table>  
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                          <input type="submit" value="送出" class="btn btn-primary" >
                                                  </div>
                                              
                                          </form>
                                      </div>
                                  </div>   
                              </div>
                          </div>
                  @endforeach

    </div>
</div>
                
                <div class="col-sm-2"></div>
                <!-- YourModal -->
                <div id="YourModal" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- YourModal content-->
                        <div class="modal-content">
                            <form action="{{ url('activity') }}" method="post" enctype="multipart/form-data" id="activity-form-new">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-header">
                                    
                                    <h5 class="modal-title" id="newModalLabel" align="center">新的資料</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            
                                          
                                </div>        
                        <div class="modal-body">
                            <table align="center" id="add_table">
                                <div class="modal-body">
                                    <br>        
                                    <div style="padding-left: 50px"><h3><b>相簿資訊</b></h3></div>
                                        <table align="center" id="add_add_table">
                                        <tr>
                                            <td style="vertical-align: top">分類</td>
                                        </tr>
                                        

                                        <tr>
                                            <td style="padding-right: 50px " required="required">活動名稱</td>
                                        <td>
                                            <input class="add_bar" name='activityname' required="required">
                                        </td>
                                        </tr>
                                        <tr>
                                        <td style="padding-right: 50px " >活動簡介</td>  
                                        <td>
                                        <textarea class="add_word" id='introduce-new' name='introduce'></textarea>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>創建時間</td>
                                        <td>  
                                        <input class="add_time" name="time" type="date" required="required">
                                        </td>
                                        </tr>   
                                        <tr>
                                        <td>
                                            <input type="radio" name="class" value="0">大學部<br>
                                            <input type="radio" name="class" value="1">碩博士班<br>
                                            <input type="radio" name="class" value="2">在職專班<br>
                                            <input type="radio" name="class" value="3">其他<br>
                                        </td>
                                        </tr>                                        
                                        </table>
                                        <table align="center" id="pic_table">
                                        <tr>
                                        <td>  
                                        <div class="addpic">上傳</div>
                                        <input type="file" id="pre_pic" name = "picture" accept="image/*" required="required">
                                        </td>
                                        </tr>    
                                        </table>
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
               {{ $activities->links() }}
               </div>

     
                                        

@endsection 

@section('js')
<!-- 放js -->

<script>
// var text = $("textarea").text(); 
// var des = text.replace(/\r\n/g, '<br/>').replace(/\n/g, '<br/>').replace(/\s/g, ' ');

// on modal show
$('.activity-edit-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $("#introduce-edit").val($("#introduce-edit").val().replace(/\<br \/\>/g,"\n"));
});

$("#activity-form-new").submit(function(){
  $("#introduce-new").val($("#introduce-new").val().replace(/\r\n|\r|\n/g,"<br />"));
});

$("#activity-form-edit").submit(function(){
  $("#introduce-edit").val($("#introduce-edit").val().replace(/\r\n|\r|\n/g,"<br />"));
});

</script>
@stop
