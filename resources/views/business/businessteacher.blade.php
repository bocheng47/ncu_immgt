@extends('layouts.layout') 
@section('title', '企業導師專區') 

@section('css')
<!-- 放css -->
<link href="{{ asset('css/course/course.css') }}" rel="stylesheet">
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
</style>
@include('fb_og')

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
				    <div class="alert alert-success">
				        {{ session()->get('success') }}
				    </div>
				@endif

				@if($auth)
			      	<div class="btn-group special" role="group">
						<button type="submit" class="btn btn-success create" style="margin-top:20px;" id="create-item">新增</button>
						<button class="btn btn-primary" data-url="{{ url()->current() }}" style="margin-top:20px;" data-social="facebook" >分享本頁</button>
					</div>
			    @endif
			    
				<div class="pdf-viewer">
					<object data="{{ '/download/course/programs/A_Programs.pdf' }}" type="application/pdf" width="100%" height="1042px"> 
					  <p>您的瀏覽器似乎不支援線上瀏覽 pdf 檔案。<br>但您可以透過點擊 <a href="{{ '/download/course/programs/A_Programs.pdf' }}"> 來下載檔案。</a></p>  
					 </object>
				</div>
			</div>
			
		</div>
    </div>
</div>

		<!-- Modal -->
	<div class="modal fade" id="the-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-id="">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	        </button>
	        <h2 class="modal-title" id="modal-label">修改檔案</h2>
	      </div>
	      <div class="modal-body" id="attachment-body-content">
	      	@if (count($errors) > 0)
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
	        <form id="modal-form" class="form-horizontal dropzone" method="POST" enctype="multipart/form-data" action="/uploadFile">
	          <div class="card text-white bg-dark mb-0">
	            
	            <div class="card-body">
	            	@csrf
	              	<!-- filename -->
	                <label class="col-form-label" id="file-input-label" for="modal-input-filename">上傳檔案</label>
	                <input type="file" name="file" accept=".pdf"/>
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


@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript" src="{{ asset('js/pdf.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/goodshare.js@5/goodshare.min.js"></script>
@if (count($errors) > 0)
	<script>
		$('#the-modal').modal('show');
	</script>
@endif
@stop
