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

					<table class="content-table" style="width: 100%;">
						<colgroup>
							@if (!$auth)
								<col style="width:25%">
						    	<col style="width:75%">
							@else
							    <col style="width:25%">
							    <col style="width:66%">
								<col style="width:3%">
							    <col style="width:3%">
							    <col style="width:3%">
						    @endif
						 </colgroup>  
						<thead>
							<tr>
						      	<th>獎學金類別</th>
						      	<th>下載</th>
						      	@if($auth)
						      		<th>修改</th>
						      		<th>刪除</th>
						      		<th>分享</th>
						      	@endif
						    </tr>
						</thead>
						<tbody>
							@php ($i = 1)
							@php($acadTypes = array("大學部", "碩士班", "博士班", "大學部、碩士班", "碩士班、博士班", "大學部、博士班", "全體學生"))
					  		@foreach($scholarships as $scholarship)
							    <tr class="data-row" data-url="{{ url('/download/course/scholarships/'.$scholarship->filename) }}" data-id="{{ $scholarship->id }}" data-acadType="{{ $scholarship->acadType }}">
							      	<td class="acadType"><a class="anchor" id="{{$scholarship->id}}"></a>{{ $acadTypes[$scholarship->acadType] }}</td>
							      	<td class="course-Title">{{ $scholarship->title }}</td>
							      	@if($auth)
							      		<td><button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button></td>
							      		<td>
							      			<form onsubmit="return confirm('您確定要刪除嗎?');" action="{{ url('course/scholarship/'.$scholarship->id) }}" method="POST" style="display: inline;">
											    @method('delete')
											    @csrf
							      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
											</form>
							      		</td>
								      	<td>
								      		<button  class="btn btn-social-icon btn-facebook" data-title="{{ $scholarship->title }}" data-description="下載" data-url="{{ url('/course/scholarship#'.$scholarship->id) }}" data-social="facebook" ><span class="fa fa-facebook"></span><span data-counter="facebook"></span></button>
								      	</td>
							     	@endif
							    </tr>
							    @php ($i++)
					    	@endforeach
						</tbody>
					</table>
				更多獎學金資訊請至Portal獎助學金暨工讀管理系統查詢<br>
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
	            	{{-- acadType --}}
	            	<label class="col-form-label" for="modal-input-acadYear">獎學金類別</label>
	            	<select id="modal-select-acadType" name="acadType" class="selectpicker form-control">
	            		<option value="" {{ (old("acadType")==null ? "selected":"") }} disabled>請選擇</option>
		                <option value="0" {{ (old("acadType")==="0" ? "selected":"") }}>大學部</option>
		                <option value="1" {{ (old("acadType")==="1" ? "selected":"") }}>碩士班</option>
		                <option value="2" {{ (old("acadType")==="2" ? "selected":"") }}>博士班</option>
		                <option value="3" {{ (old("acadType")==="3" ? "selected":"") }}>大學部、碩士班</option>
		                <option value="4" {{ (old("acadType")==="4" ? "selected":"") }}>碩士班、博士班</option>
		                <option value="5" {{ (old("acadType")==="5" ? "selected":"") }}>大學部、博士班</option>
		                <option value="6" {{ (old("acadType")==="6" ? "selected":"") }}>全體學生</option>
		            </select>
			        {{-- endacadType --}}
					<!-- title -->
	                <label class="col-form-label" for="modal-input-title">標題</label>
	                <input type="text" name="title" class="form-control" id="modal-input-title" value="{{ old("title") }}" required autofocus>
	              	<!-- /title -->
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
<script type="text/javascript" src="{{ asset('js/course/scholarship.admin.396mBvdDOyLgoOZAjs') }}"></script>
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