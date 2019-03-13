@extends('layouts.layout') 
@section('title', '師資介紹') 

@section('css')
 <!-- 放css --> 
<link rel="stylesheet" href="{{ URL::asset('/css/teacher.css') }}">
@stop

@section('content')
<!-- 主畫面 -->
<div class="container">
	<!-- 留白 -->
  <div class="row">
	<div class="col-sm-1"></div>
	<!-- 側欄 -->
	<div class="col-sm-2" id="left_bar">
    <div>
      <ul>
        <li class="sidebar_title"><b>系統組</b></li>
        <li class="sidebar_link"><a href="/teacher/gp1" class="link"><span class="glyphicon glyphicon-tag"></span>&nbsp電子商務技術</a></li>
        <li class="sidebar_link"><a href="/teacher/gp2" class="link"><span class=" glyphicon glyphicon-cd"></span>&nbsp軟體工程</a></li>
        <li class="sidebar_link"><a href="/teacher/gp3" class="link"><span class="glyphicon glyphicon-globe"></span>&nbsp企業智慧</a></li>
        <hr>
        <li class="sidebar_title"><b>管理組</b></li>
        <li class="sidebar_link"><a href="/teacher/gp4" class="link"><span class="glyphicon glyphicon-usd"></span>&nbsp電子商務</a></li>
        <li class="sidebar_link"><a href="/teacher/gp5" class="link"><span class="glyphicon glyphicon-align-left"></span>&nbsp企業策略與決策</a></li>
        <li class="sidebar_link"><a href="/teacher/gp6" class="link"><span class="glyphicon glyphicon-briefcase"></span>&nbsp行銷管理</a></li>
        <hr>
        <li class="sidebar_link"><a href="/teacher" class="link"><span class="glyphicon glyphicon-user"></span>&nbsp教師一覽</a></li>
      </ul>
    </div>
  </div>






<!-- <div class="col-sm-1"></div> -->

{{-- if the user's been authenticated --}}
@php($auth = false)
	@auth
		@if( (Auth::user()->usertype == 0) )
			@php($auth = true)
		@endif
	@endauth
                          
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
	<!-- 資料顯示欄 -->
	<div class="col-sm-9" style="padding-bottom: 50px;">
    <h5 {{ $teachers->count() > 1 ? "" : "style=display:none" }}><br>本所對於師資之延攬一向極為重視，目前{{ str_contains(url()->current(), 'gp') ? "本領域有 " : "已有 "}} {{$teachers->where('visible', 1)->count()}} 位專任教師。且有多位兼任教師分別來自資訊管理、資訊科技、決策科學、企業管理等不同領域。<br><br>(※ 以下列表除主任與副主任外，皆依姓名筆劃排序。)</h5>
    <h3 {{ $teachers->count() <= 1 ? "" : "style=display:none" }}><br>老師您好，請編輯您的資料。</h3>
    <h5 {{ $teachers->count() <= 1 && $teachers->first()->visible==0 ? " style=color:red;" : "style=display:none;" }}>您目前為隱藏老師，您只會在登入後看到您的資料，一般使用者無權檢視。</h5>
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
		<!-- 資料顯示區 -->
    <div style="padding-top: 30px; padding-bottom: 30px;"> 
      <table>
        @if($auth)
        <td><button type="button" id="new_button" data-toggle="modal" data-target="#new_Modal"><span class="glyphicon glyphicon-plus"></span> 新增老師帳號</button></td>
        @endif
      </table>
    </div>
    <div id="blcok_line">

      @foreach ($teachers as $teacher)
      @if($auth || $teacher->visible == 1 || isset($isTheTeacher))
      <div class="teacher_data">
        <div class="teacher_name">
          <table class="t_head_title">
            <tr>
              <td><span class="glyphicon glyphicon-user"></span></td>
              <td style="white-space:nowrap;">{!! $teacher->visible == 0 ? "<b style='color: red;'><<隱藏>></b>" : "" !!}<b> &nbsp&nbsp&nbsp {{ $teacher->name }}</b></td>
              <td style="white-space:nowrap; padding-left: 10px"><b>{{ $teacher->position }}</b></td>
              <td style="white-space:nowrap; padding-left: 10px" id="leader_title"><b>{{ $teacher->leader }}</b></td>
              @if( $teacher->title != null || $teacher->title != ''  )
              <td style="white-space:nowrap; padding-left: 10px; width: 200px;"><b> ( {{ $teacher->title }} ) </b></td>
              @endif      
            </tr>
          </table>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-3" align="center">
            <img class="t_img" src="{{ asset('img/teacher/'.$teacher->pic_name) }}">
          </div>
          <div class="col-sm-9">
            <table class="teacher_block">
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-education"></span> &nbsp&nbsp學歷</td>
                <td class="ba_comment">{{ $teacher->education }}</td>
              </tr>
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-thumbs-up"></span> &nbsp&nbsp專長</td>
                <td class="ba_comment">{{ $teacher->profession }}</td>
              </tr>
              @if( $teacher->awards !== NULL)
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-certificate"></span> &nbsp&nbsp獎項</td>
                <td class="ba_comment">{{ $teacher->awards }}</td>
              </tr>
              @endif
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-envelope"></span> &nbsp&nbspE-mail</td>
                <td class="ba_comment"><a class="email_link" href="mailto: {{ $teacher->email }}"> {{ $teacher->email }} </a></td>
              </tr>
              @if( $teacher->office !== NULL)
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-briefcase"></span> &nbsp&nbsp辦公室</td>
                <td class="ba_comment">{{ $teacher->office }}</td>
              </tr>
              @endif
              @if( $teacher->number !== NULL)
              <tr class="infor_tr">
                <td class="ba_title"><span class="glyphicon glyphicon-earphone"></span> &nbsp&nbsp分機</td>
                <td class="ba_comment">{{ $teacher->number }}</td>
              </tr>
              @endif
              <tr>
                <td></td>
                <td align="right">
                  <a type="button" class="more_button" data-toggle="modal" data-target="#{{'detail_Modal'.$teacher->id}}">
                    more <span class="glyphicon glyphicon-play-circle"></span>
                  </a>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
        @if($auth || isset($isTheTeacher))
        <table align="right">
          <tr>
            <td>
                <button type="button" class="detail_new_button" id="detail-edit-teacher-{{ $teacher->id }}" data-toggle="modal" data-target="#{{'detail_edit_Modal'.$teacher->id}}">新增詳細資料
                </button>
            </td>
            <td>
              <div>&nbsp</div>
            </td>
            <td>
                <button type="button" class="edit_button" id="edit-teacher-{{ $teacher->id }}" data-toggle="modal" data-target="#{{'edit_Modal'.$teacher->id}}">編輯基本資料
                </button>
            </td>
          </tr>
        </table>
        <br>
        @endif
        <br>
      </div>
      <br>
      @endif
      

      <!-- 刪除確認modal -->
<!--       <div class="modal fade" id="{{'delete_Modal'.$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                  確定刪除?
                  <form action="{{ url('teacher/'.$teacher->id) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" role="btn" class="delete_button" value="是">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit_modal_close2">Close</button>
                </div>
            </div>
        </div>
      </div>
 -->


      <!-- 編輯modal -->
      <div class="modal fade" id="{{'edit_Modal'.$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <table>
                    <tr>
                      <td>
                        <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">編輯資料</h5>
                      </td>
                      <td style="width: 500px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="edit_modal_close1">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </td>
                    </tr>
                  </table>
                </div>
                
                <div class="modal-body">
                <form method="POST" action="{{ url('teacher/'.$teacher->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                    <div style="padding-left: 50px">
                      <!--上排-->
                      <table  style="height: 50px">
                        <tr style="width: 300px">
                          <td>
                            <h3 style="width: 100px"><b>基本資料</b></h3>
                          </td>
                        <!--  <td align="right" style="width: 400px">
                            <input type="radio" name="leader" value="1">
                          <span class="checkmark"></span>
                          系主任
                          </td> -->
                        </tr>
                      </table>
                    </div>
                    
                    <!--基本資料表-->
                    <table align="center" id="add_table">
                      <tr>
                        <td class="star">*</td>
                        <td style="padding-right: 50px ">姓名</td>
                        <td><input id="t_name" class="add_bar" name='name' value="{{ $teacher->name }}"></td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td style="padding-right: 50px">學歷</td>
                        <td><input class="add_bar" name='education' value="{{ $teacher->education }}"></td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td style="padding-right: 50px">專長</td>
                        <td><input class="add_bar" name='profession' value="{{ $teacher->profession }}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">榮譽獎項</td>
                        <td><input class="add_bar" name='awards' value="{{ $teacher->awards }}"></td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td style="padding-right: 50px">E-mail</td>
                        <td><input class="add_bar" name='email' value="{{ $teacher->email }}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">辦公室</td>
                        <td><input class="add_bar" name='office' value="{{ $teacher->office }}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">分機</td>
                        <td><input class="add_bar" name='number' value="{{ $teacher->number }}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">頭銜</td>
                        <td><input class="add_bar" name='title' value="{{ $teacher->title }}"></td>
                      </tr>
                      <!-- <tr>
                        <td style="padding-right: 50px">系主任</td>
                        <td>
                          <table>
                            <input class="add_bar" name='leader'></td>
                      </tr> -->
                      @if(!isset($isTheTeacher))
                        <tr>
                          <td class="star">*</td>
                          <td style="padding-right: 50px">系主任</td>
                          <td>
                              <table>
                                <tr>
                                  <td style="width: 80px">
                                    <input type="checkbox" name="leader" value="資管系系主任"  {{ ($teacher->leader != null ? "checked":"") }}>是
                                  </td>
                                </tr>
                              </table>
                          </td>
                        </tr>
                      @endif
                      <tr>
                        <td class="star">*</td>
                        <td>照片</td>
                        <td>
                          <input type="file" class="add_bar" id="user_icon_file" name="teacher_img" placeholder="上傳圖片" value="" style="height: 30px;" >
                        </td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td>職位</td>
                        <td>
                          <select name="position" autocomplete="off">
                            <option value="教授" {{ (($teacher->position)==="教授" ? "selected":"") }}>教授</option>
                            <option value="副教授" {{ (($teacher->position)==="副教授" ? "selected":"") }}>副教授</option>
                            <option value="兼任教授" {{ (($teacher->position)==="兼任教授" ? "selected":"") }}>兼任教授</option>
                            <option value="兼任副教授" {{ (($teacher->position)==="兼任副教授" ? "selected":"") }}>兼任副教授</option>
                            <option value="助理教授" {{ (($teacher->position)==="助理教授" ? "selected":"") }}>助理教授</option>
                            <option value="講座教授" {{ (($teacher->position)==="講座教授" ? "selected":"") }}>講座教授</option>
                            <option value="兼任助理教授" {{ (($teacher->position)==="兼任助理教授" ? "selected":"") }}>兼任助理教授</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td style="vertical-align: top">組別</td>
                        <td>
                          <select name="gp" autocomplete="off">
                            <option value="1" {{ (($teacher->gp)=="1" ? "selected":"") }}>電子商務技術</option>
                            <option value="2" {{ (($teacher->gp)=="2" ? "selected":"") }}>軟體工程</option>
                            <option value="3" {{ (($teacher->gp)=="3" ? "selected":"") }}>企業智慧</option>
                            <option value="4" {{ (($teacher->gp)=="4" ? "selected":"") }}>電子商務</option>
                            <option value="5" {{ (($teacher->gp)=="5" ? "selected":"") }}>企業策略與決策</option>
                            <option value="6" {{ (($teacher->gp)=="6" ? "selected":"") }}>行銷管理</option>
                            <option value="7" {{ (($teacher->gp)=="7" ? "selected":"") }}>無</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td class="star">*</td>
                        <td style="padding-right: 50px">隱藏</td>
                        <td>
                            <table>
                              <tr>
                                <td style="width: 80px">
                                  <input type="checkbox" name="hide" {{ ($teacher->visible == 0 ? "checked":"") }}>
                                </td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">使用者帳號</td>
                        <td><input class="add_bar" name='username' value="{{ $users->where('teacher_id', $teacher->id)->first()->username}}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">密碼</td>
                        <td><input name='password' type='password'></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">確認密碼</td>
                        <td><input name='password_confirmation' type='password'></td>
                      </tr>
                      <input type="hidden" name="usertype" value="1">
                    </table>
                    <br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit_modal_close2">Close</button>
                  <button type="submit" class="btn btn-primary"  id="edit-teacher-{{ $teacher->id }}">Save changes</button>
                </div>
                </form>
            </div>
        </div>
      </div>


      <!-- 新增詳細資料modal -->
      <div class="modal fade" id="{{'detail_edit_Modal'.$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <table>
                    <tr>
                      <td>
                        <h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">新增詳細資料</h5>
                      </td>
                      <td style="width: 500px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="edit_modal_close1">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </td>
                    </tr>
                  </table>
                </div>
                
                <div class="modal-body">
                <form action="{{ url('detail') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                    <div style="padding-left: 50px">
                      <!--上排-->
                      <table  style="height: 50px">
                        <tr style="width: 300px">
                          <td>
                            <h3 style="width: 100px"><b>詳細資料</b></h3>
                          </td>
                        <!--  <td align="right" style="width: 400px">
                            <input type="radio" name="leader" value="1">
                          <span class="checkmark"></span>
                          系主任
                          </td> -->
                        </tr>
                      </table>
                    </div>
                    
                    <div align="center">類別&nbsp
                      <select name="type">
                            <option value="期刊論文">期刊論文</option>
                            <option value="研討會">研討會</option>
                            <option value="著作">著作</option>
                      </select>
                      <a type="button" class="add_detail"><span class="glyphicon glyphicon-plus-sign"></span></a>
                    </div>

                    <div style="visibility: hidden;"><input type="text" name="teacher_id" value="{{ $teacher->id }}"></div>

                    <table align="center" class="detail_edit_table">
                      <tr class="detail_bar" id="detail_1">
                        <td>
                          <input type="text" class="detail_add_bar" name='title[]'>
                        </td>
                        <td>
                          <input type="text" class="detail_year" name="year[]">
                        </td>
                        <td><a type="button" class="detail_delete" id="detail_delete1">&nbsp<span class="glyphicon glyphicon-remove-circle"></span></a></td>
                      </tr>
                    </table>
                    <br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit_modal_close2">Close</button>
                  <button type="submit" class="btn btn-primary"  id="edit-teacher-{{ $teacher->id }}">Save changes</button>
                </div>
                </form>
            </div>
        </div>
      </div>


      <!-- 詳細資料modal -->
      <div class="modal fade" id="{{'detail_Modal'.$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <table class="t_d_head_title">
                    <tr style="width: 500px; color: #0d357a; font-family: 微軟正黑體;">
                      <td style="white-space:nowrap; padding-left: 10px;"><span class="glyphicon glyphicon-user"></span></td>
                      <td style="white-space:nowrap; padding-left: 10px;"><b>{{ $teacher->name }}</b></td>
                      <td style="white-space:nowrap; padding-left: 10px;"><b>{{ $teacher->position }}</b></td>
                      @if( $teacher->title !== '' )
                      <td style="white-space:nowrap; padding-left: 10px;"><b> ( {{ $teacher->title }} ) </b></td>
                      @endif
                      <!-- <td width="70%" align="right">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="detail_modal_close1">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </td> -->
                    </tr>
                  </table>
                </div>
                
                <div class="modal-body">
                  <div class="row">
                      <!-- <div class="col-sm-1"></div> -->
                      <div class="col-sm-3" id="de_pic" align="center"><img width="90%" style="border: 3px #ece6e6 solid;" src="{{ asset('img/teacher/'.$teacher->pic_name) }}"></div>
                      <div class="col-sm-9">
                        <table class="d_teacher_block">
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-education"></span> &nbsp&nbsp學歷</td>
                            <td width=500px>{{ $teacher->education }}</td>
                          </tr>
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-thumbs-up"></span> &nbsp&nbsp專長</td>
                            <td width=500px>{{ $teacher->profession }}</td>
                          </tr>
                          @if( $teacher->awards !== null)
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-certificate"></span> &nbsp&nbsp獎項</td>
                            <td width=500px>{{ $teacher->awards }}</td>
                          </tr>
                          @endif
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-envelope"></span> &nbsp&nbspE-mail</td>
                            <td width=500px><a class="email_link" href="mailto: {{ $teacher->email }}"> {{ $teacher->email }} </a></td>
                          </tr>
                          @if( $teacher->office !== null)
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-briefcase"></span> &nbsp&nbsp辦公室</td>
                            <td width=500px>{{ $teacher->office }}</td>
                          </tr>
                          @endif
                          @if( $teacher->number !== null)
                          <tr class="infor_tr">
                            <td width=200px><span class="glyphicon glyphicon-earphone"></span> &nbsp&nbsp分機</td>
                            <td width=500px>{{ $teacher->number }}</td>
                          </tr>
                          @endif
                        </table>
                      </div>
                  </div>
                  <hr>
                  <div>
                    <div>
                      <div style="padding-left: 5%; color: #0d357a;"><b><span class="glyphicon glyphicon-file"></span> &nbsp期刊論文</b></div>
                      <div style="padding-left: 7%;">                        
                      <table width="100%">
                        @foreach($d1 as $var1)
                          @if( $var1->teacher_id == $teacher->id)
                          <tr style="padding-bottom: 10px;">
                            <td>◆</td>
                            <td style="padding-left: 10px; font-size: small;">{{ $var1->title }}</td> 
                          </tr>
                          @endif
                        @endforeach
                      </table>
                      </div>
                    </div>
                    <br>

                    <div>
                      <div style="padding-left: 5%; color: #0d357a;"><b><span class="glyphicon glyphicon-search"></span> &nbsp研討會</b></div>
                      <div style="padding-left: 7%;">                        
                      <table width="100%">
                        @foreach($d2 as $var2)
                          @if( $var2->teacher_id == $teacher->id)
                          <tr style="padding-bottom: 10px;">
                            <td>◆</td>
                            <td style="padding-left: 10px; font-size: small;">{{ $var2->title }}</td>  
                          </tr>
                          @endif
                        @endforeach
                      </table>
                      </div>
                    </div>
                    <br>

                    <div>
                      <div style="padding-left: 5%; color: #0d357a;"><b><span class="glyphicon glyphicon-book"></span> &nbsp著作</b></div>
                      <div style="padding-left: 7%;">
                      <table width="100%">
                        @foreach($d3 as $var3)
                          @if( $var3->teacher_id == $teacher->id)
                          <tr style="padding-bottom: 10px;">
                            <td>◆</td>
                            <td style="padding-left: 10px; font-size: small;">{{ $var3->title }}</td> 
                          </tr>
                          @endif
                        @endforeach
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="detail_modal_close2">Close</button>
                </div>
            </div>
        </div>
      </div>
      @endforeach
    </div>
		<!-- 按鈕 -->


	</div>
<!-- 	<div class="col-sm-1">
   <div align="center">
      <button type="button" id="new_button" data-toggle="modal" data-target="#new_Modal"><span class="glyphicon glyphicon-plus">Add</span></button>
    </div> 
  </div> -->
  </div>
</div>




<!-- 新增modal -->
<div class="modal fade" id="new_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
    				<div class="modal-content">


      					<div class="modal-header">
      						<table>
      							<tr>
        							<td>
        								<h5 class="modal-title" id="exampleModalLabel" align="left" style="width: 100px">新增資料</h5>
                      </td>
        							<td style="width: 500px">
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="new_modal_close1">
          								<span aria-hidden="true">&times;</span>
        								</button>
        							</td>
        						</tr>
        					</table>
      					</div>


                <form action="{{ url('teacher') }}" method="POST" enctype="multipart/form-data" id="dataform">
                  {{ csrf_field() }}
                {{ method_field('PATCH') }}

      					<div class="modal-body">

                    <!-- 基本資料 -->

                    <!--上排-->
      						  <div style="padding-left: 50px">
      						  	<h3 style="width: 100px"><b>基本資料</b></h3>
                    </div>

                    <!--基本資料表-->
      				  		<table align="center" id="add_table">
      				  			<tr>
                        <td class="star">*</td>
      				  				<td style="padding-right: 50px " required="required">姓名</td>
      				  				<td><input id="t_name" class="add_bar" name='name' value="{{old('name')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td class="star">*</td>
      				  				<td style="padding-right: 50px" required="required">學歷</td>
      				  				<td><input class="add_bar" name='education' value="{{old('education')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td class="star">*</td>
      				  				<td style="padding-right: 50px" required="required">專長</td>
      				  				<td><input class="add_bar" name='profession' value="{{old('profession')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td></td>
      				  				<td style="padding-right: 50px">榮譽獎項</td>
      				  				<td><input class="add_bar" name='awards' value="{{old('awards')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td class="star">*</td>
      				  				<td style="padding-right: 50px">E-mail</td>
      				  				<td><input type="email" class="add_bar" name='email' value="{{old('email')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td></td>
      				  				<td style="padding-right: 50px">辦公室</td>
      				  				<td><input class="add_bar" name='office' value="{{old('office')}}"></td>
      				  			</tr>
      				  			<tr>
                        <td></td>
      				  				<td style="padding-right: 50px">分機</td>
      				  				<td><input class="add_bar" name='number' value="{{old('number')}}"></td>
      				  			</tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">頭銜</td>
                        <td><input class="add_bar" name='title' value="{{old('title')}}"></td>
                      </tr>
      				  			<tr>
                        <td class="star">*</td>
      				  				<td style="padding-right: 50px">系主任</td>
      				  				<td>
      				  						<table>
      				  							<tr>
      				  								<td style="width: 80px">
      				  									<input type="checkbox" name="leader" value="資管系系主任">是
      				  								</td>
      				  								<!-- <td>
      				  									<input type="radio" name="leader" value="none">否
      				  								</td> -->
      				  							</tr>
      				  						</table>
      				  				</td>
      					 		  </tr>
      					 	   	<tr>
                        <td class="star">*</td>
      					 			  <td>照片</td>
      								  <td>
                          <input type="file" name="teacher_img">
      								  </td>
      							  </tr>
                      <tr>
                        <td class="star">*</td>
                        <td>職位</td>
                        <td>
                          <select name="position" autocomplete="off">
                            <option value="教授" {{ (old("position")==="教授" ? "selected":"") }}>教授</option>
                            <option value="副教授" {{ (old("position")==="副教授" ? "selected":"") }}>副教授</option>
                            <option value="兼任教授" {{ (old("position")==="兼任教授" ? "selected":"") }}>兼任教授</option>
                            <option value="兼任副教授" {{ (old("position")==="兼任副教授" ? "selected":"") }}>兼任副教授</option>
                            <option value="助理教授" {{ (old("position")==="助理教授" ? "selected":"") }}>助理教授</option>
                            <option value="講座教授" {{ (old("position")==="講座教授" ? "selected":"") }}>講座教授</option>
                            <option value="兼任助理教授" {{ (old("position")==="兼任助理教授" ? "selected":"") }}>兼任助理教授</option>
                          </select>
                        </td>
                      </tr>
      						  	<tr>
                        <td class="star">*</td>
      						  		<td style="vertical-align: top">組別</td>
      				  				<td>
                          <select name="gp" autocomplete="off">
                            <option value="1" {{ (old("gp")==="1" ? "selected":"") }}>電子商務技術</option>
                            <option value="2" {{ (old("gp")==="2" ? "selected":"") }}>軟體工程</option>
                            <option value="3" {{ (old("gp")==="3" ? "selected":"") }}>企業智慧</option>
                            <option value="4" {{ (old("gp")==="4" ? "selected":"") }}>電子商務</option>
                            <option value="5" {{ (old("gp")==="5" ? "selected":"") }}>企業策略與決策</option>
                            <option value="6" {{ (old("gp")==="6" ? "selected":"") }}>行銷管理</option>
                            <option value="7" {{ (old("gp")==="7" ? "selected":"") }}>無</option>
                          </select>
      				  				</td>
      				  			</tr>
                      <tr style="visibility: hidden;">
                        <td class="star"></td>
                        <td style="vertical-align: top">隱藏</td>
                        <td>
                          <input type="text" name="hide" value="1">
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">使用者帳號</td>
                        <td><input class="add_bar" name='username' value="{{old('username')}}"></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">密碼</td>
                        <td><input name='password' type='password'></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td style="padding-right: 50px">確認密碼</td>
                        <td><input name='password_confirmation' type='password'></td>
                      </tr>
      				  		</table>
                  </div>

                    <input id="usertype" type="hidden" class="form-control" name="usertype" value="1">

                </form>


        				<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="new_modal_close2">Close</button>
        					<button type="submit" class="btn btn-primary" id="Save_button" onclick = "$('#dataform').submit()" >Save changes</button>
      					</div>
                


                


    				</div>
  			</div>
</div>



@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript" src="{{ URL::asset('/js/teacher.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@if (count($errors) > 0)
  <script>
    if($('.modal.in').length <= 0)
    {
      $('#the-modal').modal('show');
    }
  </script>
@endif
@stop

