@extends('layouts.layout') 
@section('title', '課程及獎學金資訊') 

@section('css')
<!-- 放css -->
<link href="{{ asset('css/course/course.css') }}" rel="stylesheet">
@include('fb_og')

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
<div class="container">
	<div class="container-fluid ">
		<div class="row">		
			@include('course/vnavbar')
			<div class="col-sm-9">
				{{-- if the user's been authenticated --}}
				@php($auth = false)
				@auth
					@if( (Auth::user()->usertype == 0) )
						@php($auth = true)
					@endif
				@endauth
				{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}

				@if(session()->has('success'))
					<br>
				    <div id="successdiv" class="alert alert-success">
				        {{ session()->get('success') }}
				    </div>
				@endif
				
				@if ($auth)
					<form action="/course/double/storeArticle" method="POST">
						@csrf
						<input id="textarea_hidden" name="content" type="hidden" value="">
					    <div id="toolbar-container"></div>

					    <div id="editor" name="editor">
					        @include('course/doubleArticles/article')
					    </div>
					    <button type="submit" class="btn btn-info btn-block create" style="margin-top:20px;" id="edit-article">儲存文章</button>
					</form>
				@else
					<div class="ck-content">
						@include('course/doubleArticles/article')
					</div>
				@endif

				<div id="filesArea">
					@if ($auth)
						<div class="btn-group special" role="group">
							<button type="submit" class="btn btn-success create" style="margin-top:20px;" id="create-item">新增</button>
							<button class="btn btn-primary" data-url="{{ url()->current() }}" style="margin-top:20px;" data-social="facebook" >分享本頁</button>
						</div>
					@endif

					<table class="content-table" style="width: 100%;">
						<colgroup>
							@if (!$auth)
								<col style="width:15%">
						    	<col style="width:85%">
							@else
							    <col style="width:12%">
						    	<col style="width:73%">
							    <col style="width:5%">
							    <col style="width:5%">
							    <col style="width:5%">
						    @endif
						</colgroup> 
						<thead>
							<tr>
						      	<th>編號</th>
						      	<th>檔案名稱</th>
						      	@if($auth)
						      		<th>修改</th>
						      		<th>刪除</th>
						      		<th>分享</th>
						      	@endif
						    </tr>
						</thead>
						<tbody>
							@php ($i = 1)
					  		@foreach($doubles as $double)
							    <tr class="data-row" data-url="{{ url('/download/course/doubles/'.$double->filename) }}" data-id="{{ $double->id }}">
							      	<td class="iteration"><a class="anchor" id="{{$double->id}}"></a>{{ $i }}</td>
							      	<td class="filename">{{ $double->filename }}</td>
							      	@if($auth)
							      		<td><button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button></td>
							      		<td>
							      			<form onsubmit="return confirm('您確定要刪除嗎?');" action="{{ url('course/double/'.$double->id) }}" method="POST" style="display: inline;">
											    @method('delete')
											    @csrf
							      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
											</form>
							      		</td>
								      	<td>
								      		<button  class="btn btn-social-icon btn-facebook" data-title="{{ $double->title }}" data-description="下載" data-url="{{ url('/course/double#'.$double->id) }}" data-social="facebook" ><span class="fa fa-facebook"></span><span data-counter="facebook"></span></button>
								      	</td>
								     @endif
							    </tr>
							    @php ($i++)
					    	@endforeach
						</tbody>
					</table>
				</div>

			</div>
			
			
		</div>
    </div>
	@if($auth)
    <!-- Modal -->
	<div class="modal fade" id="the-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-id="">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	        </button>
	        <h2 class="modal-title" id="modal-label">編輯資料</h2>
	      </div>
	      <div class="modal-body" id="attachment-body-content">
	      	@if (count($errors) > 0)
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
	        <form id="modal-form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
	          <div class="card text-white bg-dark mb-0">
	            
	            <div class="card-body">
	            	@csrf
	            	<input type="hidden" name="_method" id="method" value="PATCH">
	            	<!-- filename -->
	                <label class="col-form-label" id="file-input-label" for="modal-input-filename">上傳檔案</label>
	                <input type="file" name="file" />
	              	<!-- /filename -->
	            </div>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="submitModal" data-dismiss="modal">儲存</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
	      </div>
	    </div>
	  </div>
	</div>
	{{-- end modal --}}
	@endif

</div>
@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript" src="{{ asset('js/course/course.js') }}"></script>

@if($auth)
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/decoupled-document/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
<script type="text/javascript" src="{{ asset('js/course/course.admin.dXVa1JsFxK5gLrkV.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/course/double.admin.QzWN28ucd2X5yeZM.js') }}"></script>

<script>
	var myEditor;

    DecoupledEditor
        .create( document.querySelector( '#editor' ),{
        	ckfinder: {
	            uploadUrl: '/upload_image?_token={{csrf_token()}}&cat=course'
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

@if (count($errors) > 0)
	<script>
		if($('.modal.in').length <= 0)
		{
			$('#the-modal').modal('show');
		}
	</script>
@endif
@endif
@stop