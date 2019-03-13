@extends('layouts.layout') 
@section('title', '課程及獎學金資訊') 

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

				@if(session()->has('success'))
					<br>
				    <div id="successdiv" class="alert alert-success">
				        {{ session()->get('success') }}
				    </div>
				@endif

    			<div class="tab-head">
					<ul class="nav nav-pills">
								<li class="active"><a  href="#tabAcadType0" data-toggle="tab">大學部</a></li>
								<li><a href="#tabAcadType1" data-toggle="tab">碩士班</a></li>
								<li><a href="#tabAcadType2" data-toggle="tab">博士班</a></li>
								<li><a href="#tabAcadType3" data-toggle="tab">碩士在職專班</a></li>
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
				@for($counter=0; $counter<4; $counter++)
					<div class="tab-pane fade{{$counter==0?' in active':''}}" id="{{ 'tabAcadType'.$counter }}">
						<table class="content-table tabAcadType">
							<colgroup>
								@if (!$auth)
									<col class="number" style="width:12%">
									<col style="width:15%">
							    	<col style="width:73%">
								@else
								    <col style="width:12%">
									<col style="width:15%">
							    	<col style="width:58%">
								    <col style="width:5%">
								    <col style="width:5%">
								    <col style="width:5%">
							    @endif
							</colgroup> 
							<thead>
								<tr>
							      	<th class="number">編號</th>
							      	<th>學年度</th>
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
						  		@foreach($rules->where('acadType', $counter) as $rule)
								    <tr class="data-row" data-url="{{ url('/download/course/rules/'.$rule->filename) }}" data-id="{{ $rule->id }}">
								    	<td class="iteration number"><a class="anchor" id="{{$rule->id}}"></a>{{ $i }}</td>
								    	<td class="acadYear">{{ $rule->acadYear }}</td>
								      	<td class="course-Title">{{ $rule->title }}</td>
								      	@if($auth)
								      		<td><button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button></td>
								      		<td>
								      			<form onsubmit="return confirm('您確定要刪除嗎?');" action="{{ url('course/rule/'.$rule->id) }}" method="POST" style="display: inline;">
												    @method('delete')
												    @csrf
								      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
												</form>
								      		</td>
									      	<td>
									      		<button  class="btn btn-social-icon btn-facebook" data-title="{{ $rule->title }}" data-description="下載" data-url="{{ url('/course/rule#'.$rule->id) }}" data-social="facebook" ><span class="fa fa-facebook"></span><span data-counter="facebook"></span></button>
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
                    <div class="alert alert-danger" id="errordiv">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif
		        <form id="modal-form" class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
		          <div class="card text-white bg-dark mb-0">
		            
		            <div class="card-body">
		            	@csrf
		            	<input type="hidden" name="_method" id="method" value="PATCH">
		            	{{-- acadType and acadYear --}}
		            	<label class="col-form-label" for="modal-input-acadYear">學年度 與 學制</label>
				        <div class="input-group my-group col-lg-12"> 
				            <input type="text" name="acadYear" class="form-control" id="modal-input-acadYear" value="{{ old("acadYear") }}" required>
			            	<select id="modal-select-acadType" name="acadType" class="selectpicker form-control">
			            		<option value="" {{ (old("acadType")==null ? "selected":"") }} disabled>請選擇</option>
				                <option value="0" {{ (old("acadType")==="0" ? "selected":"") }}>大學部</option>
				                <option value="1" {{ (old("acadType")==="1" ? "selected":"") }}>碩士班</option>
				                <option value="2" {{ (old("acadType")==="2" ? "selected":"") }}>博士班</option>
				                <option value="3" {{ (old("acadType")==="3" ? "selected":"") }}>碩士在職專班</option>
				            </select>
				        </div> 
				        {{-- endacadType and acadYear --}}
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
</div>

@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript" src="{{ asset('js/course/course.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/course/rule.js') }}"></script>

@if($auth)
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
<script type="text/javascript" src="{{ asset('js/course/rules.admin.YF5MArb31TxfDfW3.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/course/course.admin.dXVa1JsFxK5gLrkV.js') }}"></script>

@if (count($errors) > 0)
	<script>
		if($('.modal.in').length <= 0)
		{
			$('#the-modal').modal('show');
		}
	</script>
@endif
@if(old("acadType") != null)
	<script>
		$('[href="#tabAcadType'+{{old("acadType")}}+'"]').tab('show');
	</script>
@endif
@if(session()->has('returned'))
    <script>
		$('[href="#tabAcadType'+{{ session()->get('returned') }}+'"]').tab('show');
	</script>
@endif
<script>
	$('a[data-toggle="tab"]').on('shown.bs.tab', () => {
		$('.alert').hide();
	});
</script>
@endif
@stop