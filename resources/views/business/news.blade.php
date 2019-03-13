@extends('layouts.layout') 
@section('title', '企業導師專區') 

@section('css')
<!-- 放css -->
@include('fb_og')
<style>
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
.ck-content{
    margin: 25px auto;
}

.ck-content table, td, th {    
    border: 1px solid #b3b3b3;
    text-align: center;
}

.ck-content th, td {
    padding: 6px;
}

.ck-content img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
}
.newpost-show{
    border-style: ridge;
    border-radius:10px;
    border:2px solid #DDDDDD;
    border-left:2px solid #DDDDDD;
    border-right:2px solid #DDDDDD;
    border-bottom:2px solid #DDDDDD;
    padding: 12px;
}
.newpost-title{
    border-bottom:1px solid #DDDDDD;
    font-weight:bold;
    font-size:26px;
    padding: 8px;
}
</style>

@stop

@section('content')
<!-- 主畫面 -->
<section class="container"><br>

    <div class="container">
    <div class="container-fluid ">
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
        <li class="sidebar_link"><a href="https://www.facebook.com/groups/430606330310904" target="_blank" class="link">&nbspFacebook社團</a></li>
      </ul>
    </div>
  </div>
        <div class="container-fluid ">

        <div class="col-sm-7 contentAreaStyle"><br>

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
                <div id="maincontent">
                @if($auth)
                <div id="model" style="display:block;" onclick='showhidediv("model")';>        
                    <p>編輯模式</p>
                </div>  
                @endif
                @if ($auth)
                    <div id="fb-root"></div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                @endif
                <div id ="back" style="text-align:right;"><a href="/business" > &nbsp&nbsp回最新消息</a></div>
                    <div id="newpost-show" class="newpost-show"> 
                        <div id="title" class="newpost-title">&nbsp;{{ $businesses->title}} </div><br>
                            <div id="mid" style=" margin : 5px ; border : 0 ; padding : 0"></div>
                            <button class="btn btn-primary" style="float:right" data-url="{{ url()->current() }}" style="margin-top:20px;" data-social="facebook" >分享本頁</button>
                                <div id="show" style="display:block;" onclick='showhidediv("content")'>  
                                    {!! $businesses->content !!}
                                </div>
                                <div id="content" style="display:none;" > 
                                <form action="{{ url('business/'.$businesses->id.'/post') }}" method="POST">
                                @csrf
                                    <input id="textarea_hidden" name="content" type="hidden" value="">
                                    <div id="toolbar-container"></div>
                                        <div id="editor" name="editor">
                                            {!! $businesses->content !!}
                                        </div>
                                    <button type="submit" class="btn btn-info btn-block create" style="margin-top:20px;" id="edit-article">儲存文章</button>
                                </form>                            
                                <input type="button" value="返回內容" onclick='showhidediv("content")';>  
                            </div>
                            <a href="{{ asset('download/business_post/'.$businesses->filename) }}">
                                {!! $businesses->filename !!}
                                </a><br><br>
                                @if($auth)
                                @if(!$businesses->filename)
                                    <form action="{{ url('business/'.$businesses->id.'/storefile')}}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label class="col-form-label" id="file-input-label" for="modal-input-filename">上傳檔案</label>
                                    <input type="file" name="file"/><br>
                                    <input type="submit" value="上傳檔案" class="btn btn-primary">
                                    </form><br>
                                @endif
                                @if($businesses->filename)
                                <form action="{{ url('business/'.$businesses->id.'/deletefile') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" role="btn" class="btn bnt-danger" value="刪除檔案">
                                </form><br>
                                @endif
                                @endif
                    </div>  
                </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
</div>

</section>
@endsection 

@section('js')
<!-- 放js -->
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
<script>

    function showhidediv(id){  
  
    var model=document.getElementById("model");  

    var show=document.getElementById("show");  
  
    var content=document.getElementById("content");  
  
    if (id == 'model') {  
  
        if (content.style.display=='none') {  
  
            model.style.display='none';  
  
            content.style.display='block';  

            show.style.display='none';
  
        }  
    } 
    else if (id == 'content'){  
  
        if (model.style.display=='none') {  
  
            content.style.display='none';  
  
            model.style.display='block';  

            show.style.display='block';  
        }    
    }       
}   
</script>   

<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/decoupled-document/ckeditor.js"></script>
<script>
    var myEditor;

    DecoupledEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '/upload_image?_token={{csrf_token()}}'
            },
            image: {
                styles: [ 'full', 'side' ]
            }

        } )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            myEditor = editor;


        } )
        .catch( error => {
            console.error( error );
        } );
</script>

<script>
    $("#edit-article").click(function() {
      $("#textarea_hidden").val(myEditor.getData());
    });
</script>

@stop