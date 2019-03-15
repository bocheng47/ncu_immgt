@extends('layouts.layout') 
@section('title', '招生訊息') 

@section('css')
<!-- 放css -->
<style>
@import "compass/css3";
.content-table {
  font-family: 'Arial';
  margin: 25px auto;
  border-collapse: collapse;
  border: 1px solid #eee;
  border-bottom: 2px solid #4760bb;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10), 0px 10px 20px rgba(0, 0, 0, 0.05), 0px 20px 20px rgba(0, 0, 0, 0.05), 0px 30px 20px rgba(0, 0, 0, 0.05);
}
.content-table tbody tr:hover {
  background: #f4f4f4;
  cursor: pointer;
}
.content-table tr:hover td {
  color: #555;
}

.content-table tr.active
{
  background-color: #E6E6FA;
}

.content-table th, .content-table td {
  color: #999;
  border: 1px solid #eee;
  padding: 12px 35px;
  border-collapse: collapse;
}

.content-table td {
  padding: 12px 20px;
}

.content-table th {
  background: #4760bb;
  color: #fff;
  text-transform: uppercase;
  font-size: 12px;
}
.content-table th.last {
  border-right: none;
} 
</style>
@stop

@section('content')
<!-- 主畫面 -->
<!-- .container --> 
<div class="container"><br>

    @include('enrollment/vnavbar')

    <div class="row">

        <div class="col-sm-1"></div>

        <div class="col-sm-9">
            {{-- if the user's been authenticated --}}
            @php($auth = false)
            	@auth
            		@if( (Auth::user()->usertype == 0) )
            			@php($auth = true)
            		@endif
            	@endauth
            {{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
            

            <table class="table table-striped table-dark">
                @if($auth)
                <a href="{{ url('enrollment/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif
                <thead>
                    <tr>
                        <th scope="col">標題</th>
                        <th scope="col">學制</th>
                        <th scope="col">時間</th>
                        @if($auth)
                        <th></th>
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($enrollment_post as $post)
                <tr>
                    <td><a href="{{ url('enrollment/'.$post->id.'/post') }}"><span style="color:#4F4F4F;" >{{ $post->title }}</span></a></td>

                    <td><span style="color:#4F4F4F;" >{{ $post->degree }}</span></td>

                    <td>{{ $post->created_at->format('Y-m-d') }}</td>

                    @if($auth)
                    <td></td>
                    <td><a href="{{ url('enrollment/'.$post->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                    <td>
                    <form action="{{ url('enrollment/'.$post->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">
                        <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onClick="return confirm('確定要刪除嗎？');">
                    </form>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-2"></div>

    </div>

</div>
@endsection 

@section('js')
<!-- 放js -->
@stop
