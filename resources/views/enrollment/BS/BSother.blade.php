@extends('layouts.layout') 

@section('title', '招生訊息') 

@section('css')
<!-- 放css -->
<style>
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

        <div class="container-fluid ">

    	<div class="col-sm-9 contentAreaStyle"><br>

			<div id="maincontent">
                @if($auth)
                <div id="model" style="display:block;" onclick='showhidediv("model")';>  
                  
                    <p>編輯模式</p>

                </div>  
                @endif

                <div id="show" style="display:block;" onclick='showhidediv("content")'>  
                    
                    @include('enrollment/BS/BSother/article')

                </div>  
                  
                <div id="content" style="display:none;" >    
                  
                    <form action="/enrollment/BS/BSother/storeArticle" method="POST">
                        @csrf
                        <input id="textarea_hidden" name="content" type="hidden" value="">

                            <div id="toolbar-container"></div>

                            <div id="editor" name="editor">

                                @include('enrollment/BS/BSother/article')

                            </div>
                        <button type="submit" class="btn btn-info btn-block create" style="margin-top:20px;" id="edit-article">儲存文章</button>
                    </form>
                                

                    <input type="button" value="返回內容" class="" id="" onclick='showhidediv("content")';>  
                  
                </div>  

            </div>

            <br>
            <p style="font-size: 13px">最新資訊請至<a href="http://pdc.adm.ncu.edu.tw/adm_index.asp?roadno=62" style="text-decoration:none;" target="_blank">本校招生組</a>查詢</p><br><br>
        </div>
        <div class="col-sm-2"></div>
    </div>

</section>
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