@extends('layouts.layout') 
@section('title', '帳號管理') 

@section('css')
<!-- 放css -->
<style type="text/css">
	.custab{
	    border: 1px solid #ccc;
	    padding: 5px;
	    margin: 5% 0;
	    box-shadow: 3px 3px 2px #ccc;
	    transition: 0.5s;
	    }
	.custab:hover{
	    box-shadow: 3px 3px 0px transparent;
	    transition: 0.5s;
	    }
</style>
@stop

@section('content')
<div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle">
    	<button type="submit" class="btn btn-success create" style="margin-top:20px;" id="create-item">新增系辦帳號</button>
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>名字</th>
            <th>使用者 ID</th>
            <th>帳號類別</th>
            <th class="text-center">動作</th>
        </tr>
    </thead>
    	@php($cat = array("系辦帳號", "老師帳號"))
    	@php($i = 0)
    	@foreach($users as $user)
            <tr class="user-row" data-id="{{ $user->id }}">
                <td class="name">{{ $user->name == null ? \App\Teacher::find($user->teacher_id)->name : $user->name}}</td>
                <td class="userid">{{ $user->username }}</td>
                <td class="usertype">{{ $cat[ $user->usertype ] }}</td>
                <td class="text-center">
                	<button type="button" class="btn btn-warning edit" id="edit-item" data-item-id="{{ $i }}">修改</button> 
                	{{-- <form action="{{ url('usermanage/delete/'.$user->id) }}" method="POST" style="display: inline;">
					    @method('delete')
					    @csrf
	      				<button type="submit" class="btn btn-danger delete" id="delete-item">刪除</button>
					</form> --}}
				</td>
            </tr>
        @endforeach
    </table>
    </div>
</div>

<!-- Modal -->
		<div class="modal fade" id="the-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true" data-id="{{session()->has('message')?session()->get('message'):''}}">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
		        </button>
		        <h2 class="modal-title" id="modal-label">編輯帳號</h2>
		      </div>
		      <div class="modal-body" id="attachment-body-content">
		      	@if (count($errors) > 0)
                    <div class="alert alert-danger" id="errordiv">
                        {!! implode('<br>', $errors->all()) !!}
                    </div>
                @endif
                <div id="teacherwarnings" style="display: none;">
                    <h4>如系統一切正常，請於<b>師資介紹</b>頁面新增<b>教師帳號</b>。請勿於本頁面新增老師帳號。此處僅供系統網管人員異動。</h4>
                </div>
		      	<form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" id="modal-form">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">使用者帳號</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認密碼</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名字</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row" id="usermanage-type">
                            <label for="usertype" class="col-md-4 col-form-label text-md-right">類別</label>

                            <div class="col-md-6">
                                <select id="usertype" name="usertype" class="form-control">
                                    <option value="0" {{ (old("usertype")==="0" ? "selected":"") }}>系辦帳號</option>
                                    <option value="1" {{ (old("usertype")==="1" ? "selected":"") }}>老師帳號</option>
                                </select>
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
<script type="text/javascript" src="{{ asset('js/usermanage.js') }}"></script>
@if (count($errors) > 0)
	<script>
		if($('.modal.in').length <= 0)
		{
			$('#the-modal').modal('show');
		}
	</script>
@endif
<script>
    // JS for changing file type (url or upload)
    $( "#usertype" )
      .change(function () {
        $("#teacherwarnings").toggle();
      })
      .change();

      $('#the-modal').on('show.bs.modal', function() {
            if($("#usertype").val() === 1)
              {
                $("#teacherwarnings").show();
              }else
              {
                $("#teacherwarnings").hide();
              }
      })
      
</script>
@stop