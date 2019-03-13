@extends('layouts.layout') 
@section('title', '企業導師專區') 

@section('css')
<!-- 放css -->

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
</style>
@stop
@section('content')
<!-- 主畫面 -->
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
  <div class="col-sm-8">
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

                <div id="show" div style="border-width:3px;border-style:solid;border-color:#f0fbeb;padding:5px;" onclick='showhidediv("content")'>  
                    
                    @include('business/article4')

                </div>  
                  
                <div id="content" style="display:none;" >    
                  
                    <form action="/business/article4" method="POST">
                        @csrf
                        <input id="textarea_hidden" name="content" type="hidden" value="">

                            <div id="toolbar-container"></div>

                            <div id="editor" name="editor">

                                @include('business/article4')

                            </div>
                        <button type="submit" class="btn btn-info btn-block create" style="margin-top:20px;" id="edit-article">儲存文章</button>
                    </form>
                                

                    <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content")';>  
                  
                </div>  

            </div>
        </div>
     </div>   
  </div>
</div>

@endsection 

@section('js')
<!-- 放js -->
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