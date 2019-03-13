@extends('layouts.layout') 
@section('title', '畢業統計')
@section('css')
<!-- 放css -->
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
<html>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2" style="padding-top: 30px; font-family: 微軟正黑體;">
            <div>          
                <ul>
                    <li class="sidebar_link"><a class="link" href="{{ url('/about')}}"><span class="fa fa-university"></span>  系所介紹</a></li>
                    <li class="sidebar_link"><a class="link" href="{{ url('/about/office/aboutoffice')}}">  
                    <span class="fa fa-suitcase" aria-hidden="true"></span>   聯絡系辦</a></li>
                    <li class="sidebar_link"><a class="link" href="{{ url('/about/statistics/aboutstatistics')}}"> <span class="fa fa-graduation-cap" aria-hidden="true"></span>  畢業統計</a></li>
                </ul>
            </div>
        </div>
    <div class="col-md-9">
            <div class="insidebox">
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="40%">學制</th>
                        <th scope="col" width="30%">總畢業人數</th>
                    </tr>
                </thead>
                    <tr>
                        <td>大學部</td>
                        {{--大學部畢業總人數--}}
                        <td align="left">
                            {{ $sumofcollege }} 
                        </td>
                    </tr>
                    <tr>
                        <td>博士班</td>
                        {{--博士班畢業總人數--}}
                        <td align="left">
                            {{ $sumofphd }}      
                        </td>
                    </tr>
                    <tr>
                        <td>碩士在職專班</td>
                        {{--碩士在職專班畢業總人數--}}
                        <td align="left">
                            {{ $sumofemba }}    
                        </td>
                    </tr>
                    <tr>
                        <td>碩士</td>
                        {{--碩士畢業總人數--}}
                        <td align="left">
                            {{ $sumofms }}      
                        </td>
                    </tr>
                    <tr>
                        <td>總人數</td>
                        {{--總畢業人數--}}
                        <td align="left">
                            {{ $total }}    
                        </td>
                    </tr>
                </table>
                <br>
                <table class="table">
                @if($auth)
                <a href="{{ url('about/statistics/aboutstatistics/create') }}" role="btn" class="btn bnt-primary pull-right">新增</a>
                @endif
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">畢業年度</th>
                        <th scope="col">學制</th>
                        <th scope="col">總計</th>
                        <th scope="col">男</th>
                        <th scope="col">女</th>
                        @if($auth)
                        <th scope="col">編輯</th>
                        <th scope="col">刪除</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($query as $statistics)
                {{--計算每年度的大學畢業人數--}}
                @php
                    $totalofyearcollege = 0;
                    $totalofyearcollege = $statistics -> menofyearcollege + $statistics -> womenofyearcollege;
                @endphp
                    <tr>
                        <td width="20%">{{$statistics->year}}</td>
                        <td width="30%">大學部</td>
                        <td width="20%">{{$totalofyearcollege}}</td>
                        <td width="15%">{{$statistics->menofyearcollege}}</td>
                        <td width="15%">{{$statistics->womenofyearcollege}}</td>
                    @if($auth)
                        <td width="30%">
                            <a href="{{ url('about/statistics/aboutstatistics/'.$statistics->id.'/edit') }}" role="btn" class="btn bnt-warning">編輯</a>
                        </td>
                        <td width="30%">
                            <form action="{{ url('about/statistics/aboutstatistics/'.$statistics->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type=submit role="btn" value="刪除" class="btn bnt-danger" onclick="return confirm('確定要刪除嗎?');">
                        </form>
                        </td>
                    @endif
                    </tr>
                {{--計算每年度的博士班畢業人數--}}
                @php
                    $totalofphd = 0;
                    $totalofyearphd = $statistics-> menofyearphd + $statistics -> womenofyearphd;
                @endphp
                    <tr>
                        <td width="20%">{{$statistics->year}}</td>
                        <td width="30%">博士班</td>
                        <td width="20%">{{$totalofyearphd}}</td>
                        <td width="15%">{{$statistics->menofyearphd}}</td>
                        <td width="15%">{{$statistics->womenofyearphd}}</td>
                        @if($auth)
                        <td width="30%"></td>
                        <td width="30%"></td>
                        @endif
                    </tr>
                {{--計算每年度的在職專班畢業人數--}}
                @php
                    $totalofyearemba = 0;
                    $totalofyearemba = $statistics-> menofyearemba + $statistics -> womenofyearemba;
                @endphp
                    <tr>
                        <td width="20%">{{$statistics->year}}</td>
                        <td width="30%">碩士在職專班</td>
                        <td width="20%">{{$totalofyearemba}}</td>
                        <td width="15%">{{$statistics->menofyearemba}}</td>
                        <td width="15%">{{$statistics->womenofyearemba}}</td>
                        @if($auth)
                        <td width="30%"></td>
                        <td width="30%"></td>
                        @endif
                    </tr>
                {{--計算每年度的碩士班畢業人數--}}
                @php
                    $totalofyearms = 0;
                    $totalofyearms = $statistics-> menofyearms + $statistics -> womenofyearms;
                @endphp
                    <tr>
                        <td width="20%">{{$statistics->year}}</td>
                        <td width="30%">碩士班</td>
                        <td width="20%">{{$totalofyearms}}</td>
                        <td width="15%">{{$statistics->menofyearms}}</td>
                        <td width="15%">{{$statistics->womenofyearms}}</td>
                        @if($auth)
                        <td width="30%"></td>
                        <td width="30%"></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
</html>
@endsection 

@section('js')
<!-- 放js -->
<script type="text/javascript">
     // CKEDITOR.replace('content');

    $('.modal').on('show.bs.modal', function() {
      // prevent modal appear under background
      $(this).appendTo("body");
    })

</script>
<script type="text/javascript">
</script>

@stop

