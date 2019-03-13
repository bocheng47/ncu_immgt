@extends('layouts.layout') 
@section('title', '下載專區') 

@section('css')
<!-- 放css -->
<link href="{{ asset('css/course/course.css') }}" rel="stylesheet">
<style type="text/css">
@media (max-width : 767px) { 
    .number{
    	display: none;
    }
}
</style>
@include('fb_og')

@stop

@section('content')
<!-- 主畫面 -->
<div class="container">
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

	<div class="tab-head">
		<ul class="nav nav-pills">
					<li class="active"><a href="#tabFileType0" data-toggle="tab">系上相關表格</a></li>
					<li><a href="#tabFileType1" data-toggle="tab">學籍相關表格</a></li>
					<li><a href="#tabFileType2" data-toggle="tab">成績相關表格</a></li>
					<li><a href="#tabFileType3" data-toggle="tab">碩士論文表格</a></li>
					<li><a href="#tabFileType4" data-toggle="tab">博士論文表格</a></li>
		</ul>

		@if($auth)
	      	<div class="btn-group special" role="group">
				<button type="submit" class="btn btn-success create" style="margin-top:20px;" id="create-item">新增</button>
				<button class="btn btn-primary" data-url="{{ url()->current() }}" style="margin-top:20px;" data-social="facebook" >分享本頁</button>
			</div>
	    @endif

	</div>

	<div class="tab-content">
	{{-- Tables --}}
	@for($counter=0; $counter<5; $counter++)
		<div class="tab-pane fade{{$counter==0?' in active':''}}" id="{{ 'tabFileType'.$counter }}">
			<table class="content-table tabFileType">
				<colgroup>
					@if (!$auth)
						<col style="width:12%">
				    	<col class="number" style="width:88%">
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
				      	<th class="number">編號</th>
				      	<th>標題</th>
				      	@if($auth)
				      		<th>修改</th>
				      		<th>刪除</th>
				      		<th>分享</th>
				      	@endif
				    </tr>
				</thead>
				<tbody>
					@php ($i = 1)
			  		@foreach($files->where('filetype', $counter) as $file)
					    <tr class="data-row {{ is_null($file->fileurl) ? '' : ' ext_url' }}" data-url="{{ is_null($file->fileurl) ? url('/download/files/downloads/'.$file->filename) : $file->fileurl }}" data-id="{{ $file->id }}">
					    	<td class="iteration number"><a class="anchor" id="{{$file->id}}"></a>{{ $counter."-".$i }}</td>
					      	<td class="FileTitle">{{ $file->title }}</td>
					      	@if($auth)
					      		<td><button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button></td>
					      		<td>
					      			<form onsubmit="return confirm('您確定要刪除嗎?');" action="{{ url('files/'.$file->id) }}" method="POST" style="display: inline;">
									    @method('delete')
									    @csrf
					      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
									</form>
					      		</td>
						      	<td>
						      		<button  class="btn btn-social-icon btn-facebook" data-title="{{ $file->title }}" data-description="下載" data-url="{{ url('/files#'.$file->id) }}" data-social="facebook" ><span class="fa fa-facebook"></span><span data-counter="facebook"></span></button>
						      	</td>
						     @endif
					    </tr>
					    @php ($i++)
			    	@endforeach
				</tbody>
			</table>
		</div>
	@endfor
	</div>
	@if($auth)
			<!-- Modal -->
		<div class="modal fade" id="the-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-id="{{session()->has('message')?session()->get('message'):''}}">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
		        </button>
		        <h2 class="modal-title" id="modal-label">編輯資料</h2>
		      </div>
		      <div class="modal-body" id="attachment-body-content">
		      	@if (count($errors) > 0)
                    <div class="alert alert-danger" id="errordiv">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif
		        <form id="modal-form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
		          <div class="card text-white bg-dark mb-0">
		            
		            <div class="card-body">
		            	@csrf
		            	<input type="hidden" name="_method" id="method" value="PATCH">
		            	<label class="col-form-label" for="modal-input-filetype">檔案類別</label>
		            	<div class="input-group my-group col-lg-12"> 
			            	{{-- filetype --}}
			            	<select id="modal-select-filetype" name="filetype" class="selectpicker form-control">
			            		<option value="" {{ (old("filetype")==null ? "selected":"") }} disabled>請選擇</option>
				                <option value="0" {{ (old("filetype")==="0" ? "selected":"") }}>系上相關表格</option>
				                <option value="1" {{ (old("filetype")==="1" ? "selected":"") }}>學籍相關表格</option>
				                <option value="2" {{ (old("filetype")==="2" ? "selected":"") }}>成績相關表格</option>
				                <option value="3" {{ (old("filetype")==="3" ? "selected":"") }}>碩士論文表格</option>
				                <option value="4" {{ (old("filetype")==="4" ? "selected":"") }}>博士論文表格</option>
				            </select>
					        {{-- end filetype --}}
					        {{-- uploadtype --}}
					        <select id="modal-select-uploadtype" name="uploadtype" class="selectpicker form-control">
				                <option value="file" {{ (old("uploadtype")==="file" ? "selected":"") }}>上傳檔案</option>
				                <option value="fileurl" {{ (old("uploadtype")==="fileurl" ? "selected":"") }}>貼上連結</option>
				            </select>
					        {{-- /uploadtype --}}
					    </div>
		              	<!-- title -->
		                <label class="col-form-label" for="modal-input-title">標題</label>
		                <input type="text" name="title" class="form-control" id="modal-input-title" value="{{ old("title") }}" required autofocus>
		              	<!-- /title -->
		              	<!-- filename -->
		              	<div id="file" class="filearea" style="display:none">
			                <label class="col-form-label" id="file-input-label" for="modal-input-filename">上傳檔案</label>
			                <input type="file" name="file" />
			            </div>
		              	<!-- /filename -->
		              	<!-- fileurl -->
		              	<div id="fileurl" class="filearea" style="display:none">
			                <label class="col-form-label" id="fileurl-input-label" for="modal-input-fileurl">檔案連結 (網址應包含 http:// 或 https://)</label>
			                <input type="text" name="fileurl" class="form-control" id="modal-input-fileurl" value="{{ old("fileurl") }}" required autofocus>
			            </div>
		              	<!-- /fileurl -->
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
<script type="text/javascript" src="{{ asset('js/files.js') }}"></script>

@if($auth)
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
<script type="text/javascript" src="{{ asset('js/files.admin.VyvHHbfcrEJpn6ZH.js') }}"></script>
@if (count($errors) > 0)
	<script>
		if($('.modal.in').length <= 0)
		{
			$('#the-modal').modal('show');
		}
	</script>
@endif
@if(old("filetype") != null)
	<script>
		$('[href="#tabFileType'+{{old("filetype")}}+'"]').tab('show');
	</script>
@endif
@if(session()->has('returned'))
    <script>
		$('[href="#tabFileType'+{{ session()->get('returned') }}+'"]').tab('show');
	</script>
@endif

<script>
	$('a[data-toggle="tab"]').on('shown.bs.tab', () => {
		$('.alert').hide();
	});
</script>
@endif

@stop