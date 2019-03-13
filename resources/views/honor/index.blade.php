@extends('layouts.layout') 
@section('title', '榮譽榜') 

@section('css')
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->
<!-- .container --> 
<div class="container"><br>

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

        <div class="col-sm-9">
            
            @if($auth)
            <a href="{{ url('honor/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
            @endif
            
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">標題</th>
                        <th scope="col">時間</th>
                        @if($auth)
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($honor_post as $post)
                <tr>
                    <td><a href="{{ url('honor/'.$post->id.'/content') }}"><span style="color:#4F4F4F;" >{{ $post->title }}</span></a></td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>

                    @if($auth)
                    <td><a href="{{ url('honor/'.$post->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a></td>
                    <td><form action="{{ url('honor/'.$post->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">
                        <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onClick="return confirm('確定要刪除嗎？');">
                    </form></td>
                    @endif
                    
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div align="center" id="page">
                {{ $honor_post->links() }}
            </div>

        </div>

        <div class="col-sm-2"></div>

    </div>

</div>
@endsection 

@section('js')
<!-- 放js -->
@stop
