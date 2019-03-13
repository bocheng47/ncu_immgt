@extends('layouts.layout') 
@section('title', '關於本系')
@section('css')
<style>
@media screen and (max-width : 768px) {
    .displaynone{
        display: none;
    }
}
@media (min-width : 1024px) {
    .menu{
    position: fixed;
    left: 200px;
    width: 10em;
    margin-top: -2.5em;
    }
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

.insidebox_title{
    font-size:20px;
    color:#3261e1;
}

.edit_button{
    background-color: #f0ad4e;
    border: none;
    color: white;
    padding: 10px;
    font-family: 微軟正黑體;
    border-radius: 5px;
}

</style>
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->
{{-- if the user's been authenticated --}}
@php
    $auth = false
@endphp
@auth
    @if( (Auth::user()->usertype == 0) )
        @php
            $auth = true
        @endphp
    @endif
@endauth
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
<html>
<head>
{{--     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 --}}    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target="#navbar-example3">
{{-- if the user's been authenticated --}}
@php($auth = false)
	@auth
		@if( (Auth::user()->usertype == 0) )
			@php($auth = true)
		@endif
	@endauth
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
<div class="container">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-2 sticky-top" style="padding-top: 30px; font-family: 微軟正黑體;">
                <ul class="menu">
                    <li class="sidebar_link"><a class="link" href="{{ url('/about')}}"><span class="fa fa-university"></span> 系所介紹</a></li>
                    <nav id="navbar-example3" class=" navbar-light bg-light">
                    <nav class="nav nav-pills flex-column displaynone">
                            <ul class="smalltitle">
                            <nav class="nav nav-pills flex-column">
                                <li class="sidebar_link"><a class="link" href="#title1">系史</a></li>
                                <li class="sidebar_link"><a class="link" href="#title2">教學目標</a></li>
                                <li class="sidebar_link"><a class="link" href="#title3">重要成就</a></li>
                                <li class="sidebar_link"><a class="link" href="#title4">發展目標</a></li>
                                <li class="sidebar_link"><a class="link" href="#title5">系所特色</a></li>
                                <li class="sidebar_link"><a class="link" href="#title6">本系宗旨</a></li>
                            </nav>
                            </ul> 
                    </nav>  
                    </nav>              
                    <li class="sidebar_link"><a href="{{ url('/about/office/aboutoffice')}}"><span class="fa fa-suitcase" aria-hidden="true"></span> 聯繫系辦</a></li>
                    <li class="sidebar_link"><a href="{{ url('/about/statistics/aboutstatistics')}}"><span class="fa fa-graduation-cap" aria-hidden="true"></span> 畢業統計</a></li>
                </ul>  
        </div>
        <div class="col-md-8" style="padding-top: 30px;">
            {{--Scrollspy滾動監控--}}
            <div data-spy="scroll" data-target="#navbar-example3" data-offset="0">  
                <div>
                    <div id="model1" style="display:block;" onclick='showhidediv("model", 1)' class="tab-pane fade in active">  
                        <div id="title1" class="insidebox_title" style="padding-top:100px;
                            margin-top: -100px;">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <b>系史</b>
                        </div>
                        <br>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show1" style="display:block;" onclick='showhidediv("content", 1)'>  
                        
                        @include('about/article1')

                    </div>  
                    @if($auth)
                    <div id="content1" style="display:none;" >    
                      
                        <form action="/about/storeArticle1" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container1"></div>

                                <div id="editor1" name="editor1" class="editor">

                                    @include('about/article1')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article1">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 1)';>  
                    </div>  
                    @endif
                <div>
                    <div id="model2" style="display:block;" onclick='showhidediv("model", 2)' class="tab-pane fade in active">  
                        <div id="title2" class="insidebox_title" style="padding-top:100px;
                            margin-top: -100px;">
                            <i class="fa fa-anchor" aria-hidden="true"></i>
                            <b>教學目標</b>
                        </div>
                        <br>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show2" style="display:block;" onclick='showhidediv("content", 2)'>  
                        
                        @include('about/article2')

                    </div>  
                    @if($auth) 
                    <div id="content2" style="display:none;" >    
                      
                        <form action="/about/storeArticle2" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container2"></div>

                                <div id="editor2" name="editor2" class="editor">

                                    @include('about/article2')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article2">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 2)';>  
                      
                    </div>  
                    @endif
                </div>
                <div>
                    <div id="model3" style="display:block;" onclick='showhidediv("model", 3)' class="tab-pane fade in active">  
                        <div id="title3" class="insidebox_title" style="padding-top: 100px;
                            margin-top: -100px;">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                            <b>重要成就</b>
                        </div>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show3" style="display:block;" onclick='showhidediv("content", 3)'>  
                        
                        @include('about/article3')

                    </div>  
                    @if($auth) 
                    <div id="content3" style="display:none;" >    
                      
                        <form action="/about/storeArticle3" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container3"></div>

                                <div id="editor3" name="editor3" class="editor">

                                    @include('about/article3')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article3">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 3)';>  
                      
                    </div>  
                    @endif
                </div>
                <div>
                    <div id="model4" style="display:block;" onclick='showhidediv("model", 4)' class="tab-pane fade in active">  
                        <div id="title4" class="insidebox_title" style="padding-top: 100px;
                            margin-top: -100px;">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <b>發展目標</b>
                        </div>
                        <br>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show4" style="display:block;" onclick='showhidediv("content", 4)'>  
                        
                        @include('about/article4')

                    </div>  
                    @if($auth) 
                    <div id="content4" style="display:none;" >    
                      
                        <form action="/about/storeArticle4" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container4"></div>

                                <div id="editor4" name="editor4" class="editor">

                                    @include('about/article4')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article4">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 4)';>  
                      
                    </div> 
                    @endif 
                </div>
                <div>
                    <div id="model5" style="display:block;" onclick='showhidediv("model", 5)' class="tab-pane fade in active">  
                        <div id="title5" class="insidebox_title" style="padding-top: 100px;
                            margin-top: -100px;">
                            <i class="fa fa-eyedropper" aria-hidden="true"></i>
                            <b>系所特色</b>
                        </div>
                        <br>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show5" style="display:block;" onclick='showhidediv("content", 5)'>  
                        
                        @include('about/article5')

                    </div>  
                    @if($auth) 
                    <div id="content5" style="display:none;" >    
                      
                        <form action="/about/storeArticle5" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container5"></div>

                                <div id="editor5" name="editor5" class="editor">

                                    @include('about/article5')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article5">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 5)';>  
                      
                    </div>  
                    @endif
                </div>
                <div>
                    <div id="model6" style="display:block;" onclick='showhidediv("model", 6)' class="tab-pane fade in active">  
                        <div id="title6" class="insidebox_title" style="padding-top: 100px;
                            margin-top: -100px;">
                            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            <b>系所宗旨</b>
                        </div>
                        <br>
                        @if($auth)
                            <button class="edit_button">編輯</button>
                        @endif
                    </div>  

                    <div id="show6" style="display:block;" onclick='showhidediv("content", 6)'>  
                        
                        @include('about/article6')

                    </div>  
                    @if($auth) 
                    <div id="content6" style="display:none;" >    
                      
                        <form action="/about/storeArticle6" method="POST">
                            @csrf
                            <input class="textarea_hidden" id="textarea_hidden" name="content" type="hidden" value="">

                                <div id="toolbar-container6"></div>

                                <div id="editor6" name="editor6" class="editor">

                                    @include('about/article6')

                                </div>
                            <button type="submit" class="btn btn-info btn-block create  edit-article" style="margin-top:20px;" id="edit-article6">儲存內容</button>
                        </form>
                                    

                        <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content", 6)';>  
                      
                    </div>
                    @endif  
                </div>
            </div>
        </div>
        </div>
        <div class="col=md-1">
        </div>
    </div>
</div>
</div>
</body>
</html>
@endsection 

@section('js')
<!-- 放js -->
<script>

    function showhidediv(type, id){  
  
    var model=document.getElementById("model"+id);  

    var show=document.getElementById("show"+id);  
  
    var content=document.getElementById("content"+id); 
  
    if (type == 'model') {  
  
        if (content.style.display=='none') {  
  
            model.style.display='none';  
  
            content.style.display='block';  

            show.style.display='none';
            
            createEditor(id);
        }  
    } 
    else if (type == 'content'){  
  
        if (model.style.display=='none') {  
  
            content.style.display='none';  
  
            model.style.display='block';  

            show.style.display='block';  
        }    
    } 
    
}   

</script>   

<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/decoupled-document/ckeditor.js"></script>
<script>
    var myEditor;
    function createEditor(id)
    {
        DecoupledEditor
            .create( document.querySelector( '#editor'+id ),{
                ckfinder: {
                    uploadUrl: '/upload_image?_token={{csrf_token()}}&cat=about'
                },
                image: {
                    styles: [ 'full', 'side' ]
                }

            } )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container'+id );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                myEditor = editor;


            } )
            .catch( error => {
                console.error( error );
            } );
    }
    
</script>

<script>
    $(".edit-article").click(function() {
      $($(this)).parent().children()[1].value = myEditor.getData();
    });
</script>
</body>

@stop

