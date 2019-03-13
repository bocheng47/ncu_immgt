@extends('layouts.layout') 
@section('title', '問卷調查') 

@section('css')
<!-- 放css -->
<style>
@import "compass/css3";
.content-table {
  font-family: 'Arial';
 /* margin: 25px auto;*/
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
<div class="container">
    <div class="row">

        <div class="col-sm-2"></div>

        <div class="col-sm-9"><br>

            <div id="maincontent">
                @if($auth)
                <a href="{{ url('questionnarie/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif
                <table class="content-table">
                    <tr align="center">
                        <th width="50%">標題</th>
                        <th width="30%">學制</th>
                        <th width="70%">填寫表單</th>
                        @if($auth)
                        <th>編輯</th>
                        <th>刪除</th>
                        @endif
                    </tr>
                    @foreach($query as $var)
                    {{--判斷標題要rowspan多少格--}}
                    @php 
                    $var -> count =0;
                        if($var->class1 != null)
                        $var -> count = $var -> count +1;
                        if($var->class2 != null)
                        $var -> count = $var -> count +1;
                        if($var->class3 != null)
                        $var -> count = $var -> count +1;
                        if($var->class4 != null)
                        $var -> count = $var -> count +1;
                    @endphp
                    <tr>
                        <td rowspan="{{$var -> count}}"> {{ $var->title }} </td>
                        <td> {{ $var->class1 }}</td>
                        <td align="center"><a href="{{ $var->hreftocollege }}" target="_blank">
                            @if($var->hreftocollege != null)
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8J6_MQK_fVK2rGGlCEUIUnSqdYNLoYHS3V-acwV1KniXOcZt-" width="30%" align="left">
                            @endif
                            </a></td>
                        @if($auth)
                        <td> 
                            <a href="{{ url('questionnarie/'.$var->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a> 
                        </td>
                        <td> 
                            <form action="{{ url('questionnarie/'.$var->id) }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="submit" role="btn" class="btn bnt-primary" value="刪除" onclick="return confirm('確定要刪除嗎?');">
                            </form>
                        </td>
                        @endif
                    </tr>
                    @if($var->class2 != null)
                    <tr>
                        <td> {{ $var->class2 }}</td>
                        <td align="center"> <a href="{{ $var->hreftoms}}" target="_blank">
                        @if($var->hreftoms != null)
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8J6_MQK_fVK2rGGlCEUIUnSqdYNLoYHS3V-acwV1KniXOcZt-" width="30%" align="left">
                        @endif
                        </a></td>
                        @if($auth)
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endif
                    @if($var->class3 != null)
                    <tr>
                        <td> {{ $var->class3 }} </td>
                        <td align="center"> <a href="{{ $var->hreftophd }}" target="_blank">
                        @if($var->hreftophd != null)
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8J6_MQK_fVK2rGGlCEUIUnSqdYNLoYHS3V-acwV1KniXOcZt-" width="30%" align="left">
                        @endif
                        </a></td>
                        @if($auth)
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endif
                    @if($var->class4 != null)
                    <tr>
                        <td> {{ $var->class4 }} </td>
                        <td align="center"> <a href="{{ $var->hreftoemba }}" target="_blank">
                        @if($var->hreftoemba != null)
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8J6_MQK_fVK2rGGlCEUIUnSqdYNLoYHS3V-acwV1KniXOcZt-" width="30%" align="left">
                        @endif
                        </a></td>
                        @if($auth)
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                </table>                                            
            </div>
        </div>

</div>
</div>
@endsection 

@section('js')
<!-- 放js -->
@stop
