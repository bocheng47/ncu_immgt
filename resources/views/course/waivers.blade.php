@extends('layouts.layout') 
@section('title', '課程及獎學金資訊') 

@section('css')
<!-- 放css -->
<link href="{{ asset('css/course/course.css') }}" rel="stylesheet">
@include('fb_og')

@stop

@section('content')
<!-- 主畫面 -->
<div class="container">
	<div class="container-fluid ">
		<div class="row">		
			@include('course/vnavbar')
			<div class="col-sm-9 contentAreaStyle">
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

				@if($auth)
			      	<div class="btn-group special" role="group">
						<button type="submit" class="btn btn-success create" style="margin-top:20px;" id="create-item">新增</button>
						<button class="btn btn-primary" data-url="{{ url()->current() }}" style="margin-top:20px;" data-social="facebook" >分享本頁</button>
					</div>
			    @endif

				<table class="content-table">
					<colgroup>
						@if (!$auth)
							<col style="width:12%">
							<col style="width:73%">
					    	<col style="width:15%">
						@else
						    <col style="width:12%">
							<col style="width:58%">
					    	<col style="width:15%">
						    <col style="width:5%">
						    <col style="width:5%">
						    <col style="width:5%">
					    @endif
					 </colgroup>  
					<thead>
						<tr>
							<th>編號</th>
					      	<th>標題</th>
					      	<th>發表日期</th>
					      	@if($auth)
					      		<th>修改</th>
					      		<th>刪除</th>
					      		<th>分享</th>
					      	@endif
					    </tr>
					</thead>
					<tbody>
						@php ($i = 1)
				  		@foreach($waivers as $waiver)
						    <tr class="data-row" data-url="{{ url('/download/course/waivers/'.$waiver->filename) }}" data-id="{{ $waiver->id }}">
						    	<td class="iteration"><a class="anchor" id="{{$waiver->id}}"></a>{{ $i }}</td>
						      	<td class="course-Title">{{ $waiver->title }}</td>
						    	<td class="create_date">{{ $waiver->create_date }}</td>
						      	@if($auth)
						      		<td><button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button></td>
						      		<td>
						      			<form onsubmit="return confirm('您確定要刪除嗎?');" action="{{ url('course/waiver/'.$waiver->id) }}" method="POST" style="display: inline;">
										    @method('delete')
										    @csrf
						      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
										</form>
						      		</td>
							      	<td>
							      		<button  class="btn btn-social-icon btn-facebook" data-title="{{ $waiver->title }}" data-description="下載" data-url="{{ url('/course/waiver#'.$waiver->id) }}" data-social="facebook" ><span class="fa fa-facebook"></span><span data-counter="facebook"></span></button>
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
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
	        <form id="modal-form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
	          <div class="card text-white bg-dark mb-0">
	            
	            <div class="card-body">
	            	@csrf
	            	<input type="hidden" name="_method" id="method" value="PATCH">
	            	<!-- title -->
	                <label class="col-form-label" for="modal-input-title">標題</label>
	                <input type="text" name="title" class="form-control" id="modal-input-title" value="{{ old("title") }}" required autofocus>
	              	<!-- /title -->
	              	<label class="col-form-label" for="modal-input-date">發表日期</label>
	              	<input type="date" name="create_date" class="form-control" id="modal-input-date" value="{{ old("create_date") }}" required>
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
<script type="text/javascript" src="{{ asset('js/course/waiver.admin.g6Rxcoj8JnF6hkCq.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/course/course.admin.dXVa1JsFxK5gLrkV.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
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