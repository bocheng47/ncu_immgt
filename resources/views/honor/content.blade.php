@extends('layouts.layout') 

@section('title', '榮譽榜') 

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

                <h1>{{ $honor_post->title }}</h1>

                @if($honor_post->updated_at)
                <div style="text-align:right;" style="font-size: 13px">{{ $honor_post->updated_at->format('Y-m-d') }}</div> 
                @endif

                <hr class="style-one" />
                
                <div id="show" style="display:block;" onclick='showhidediv("content")'>  
                    
                   	{!! $honor_post->content !!}

                </div>  
                  
                <div id="content" style="display:none;" >
                  
                    <form action="{{ url('honor/'.$honor_post->id.'/content/update') }}" method="POST">
                        @csrf
                        <input id="textarea_hidden" name="content" type="hidden" value="">

                            <div id="toolbar-container"></div>

                            <div id="editor" name="editor">

                                {!! $honor_post->content !!}

                            </div>
                        <button type="submit" class="btn btn-info btn-block create" style="margin-top:20px;" id="edit-article">儲存文章</button>
                    </form>
                                

                    <input type="button" value="返回內容" onclick='showhidediv("content")';>  
                  
                </div>  

                <a href="{{ asset('download/honor_post/'.$honor_post->filename) }}">
                    {!! $honor_post->filename !!}
                </a><br><br>
                
                @if($auth)
                    @if(!$honor_post->filename)
                        <form action="{{ url('honor/'.$honor_post->id.'/storefile')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <label class="col-form-label" id="file-input-label" for="modal-input-filename">上傳檔案</label>
                            <input type="file" name="file"/><br>
                            <input type="submit" value="上傳檔案" class="btn btn-primary">
                        </form><br>
                    @endif
                    @if($honor_post->filename)
                        <form action="{{ url('honor/'.$honor_post->id.'/deletefile') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" role="btn" class="btn bnt-danger" value="刪除檔案" onClick="return confirm('確定要刪除嗎？');">
                        </form><br>
                    @endif
                @endif

            </div>
        </div>
    </div>
    <div class="col-sm-2"></div>

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
<style type="text/css">
    /* 漸變 color1 - color2 - color1 */

    hr.style-one {
        border: 0;
        height: 1px;
        background: #333;
        background-image: linear-gradient(to right, #ccc, #333, #ccc);
    }

</style>

@stop

