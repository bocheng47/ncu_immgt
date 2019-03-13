@extends('layouts.layout') 
@section('title', '最新消息') 

@section('css')
<!-- 放css -->
@stop

@section('content')
<!-- 主畫面 -->
<!-- .container --> 
{{-- if the user's been authenticated --}}
@php
    $auth = false
@endphp
@auth
    @if( (Auth::user()->usertype == 0) )
        @php
            $auth = true
        @endphp
    @endif
@endauth
{{-- if the user's been authenticated ends. 0 = admins, 1 = teachers. --}}
<div class="container"><br>

    <div class="row" style="padding-bottom: 50px;">

        <div class="col-sm-1"></div>

        <div class="col-sm-9">
            
            <table align="center" id="demo-infor-table">
                            <thead>
                                <tr>
                                    <th width="20%">類別</th>
                                    <th width="30%">標題</th>
                                    <th width="10%">附件</th>
                                    <th width="20%">發佈時間</th>
                                    @if($auth)
                                    <th width="10%">編輯</th>
                                    <th width="10%">刪除</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="news-data">
                                @foreach ($homes as $home)
                                <tr>
                                    <td>{{ $home->category }}</td>
                                    <td><a href="{{ url('homes/'.$home->id.'/post') }}"><span style="color:#4F4F4F;" >{{ $home->title }}</span></a></td>
                                    <td>
                                        @if($home->filename!==NULL)
                                            <span class="glyphicon glyphicon-file"></span>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('Y-m-d', strtotime($home->created_at))}}
                                    </td>
                                    @if($auth)
                                    
                                    
                                    <td>
                                        <a href="{{ url('news/'.$home->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('news/'.$home->id) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="submit" role="btn" class="btn bnt-danger" value="刪除" onclick="return confirm('確定要刪除嗎?');">
                                        </form>
                                    </td>
                                    @endif
                                    

                                </tr>
                                @endforeach
                            </tbody>
            </table>

            <div align="center" id="page">
                {{ $homes->links() }}
            </div>

        </div>

        <div class="col-sm-2"></div>

    </div>

</div>

@endsection 

@section('js')
<!-- 放js -->
@stop
