<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>國立中央大學資訊管理學系</title>
    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- off-canvas -->
    <link href="{{asset('css/mobile-menu.css')}}" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">    
    <!-- Flat Icon -->
    <link href="{{asset('fonts/flaticon/flaticon.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

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

<div id="main-wrapper">

<!-- Page Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>


    <div class="uc-mobile-menu-pusher">

        <div class="content-wrapper">


<!-- Header Top -->
            <div class="header-top visible-md visible-lg visible-sm visible-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-4"></div>
                        <div class="col-sm-12 col-md-8">
                            <ul class="top-contact pull-right">                    
                                <li class="get-a-quote"><a href="mailto:ncu6500@ncu.edu.tw" title="">聯絡我們</a></li>
                                <li class="get-a-quote"><a target="_blank" rel="noopener noreferrer" href="http://140.115.80.30:82/" title="">設備借用系統</a></li>
                                
                                <li class="get-a-quote"><a href="{{ url('http://deptmember.im.mgt.ncu.edu.tw/01/main.php') }}">系友專區</a></li>
                                <li class="get-a-quote"><a href="{{ url('/files') }}">下載專區</a></li>
                                <li class="get-a-quote"><a href="#" title="">English</a></li>
                                <li class="get-a-quote"><a target="_blank" rel="noopener noreferrer" href="https://www.ncu.edu.tw/" title="">中大首頁</a></li>

                                            {{-- <li><a href="#">登入</a></li> --}}
                @guest
                    <li class="get-a-quote"><a href="#" data-toggle="modal" data-target="#login-modal">登入</a></li>
                @else
                    <li class="get-a-quote nav-link dropdown dropdown-toggle"><a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name == null ? \App\Teacher::find( Auth::user()->teacher_id)->name." 老師"  : Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li><a style="color: black;" href="#" data-toggle="modal" data-target="#changeusernamepassword-modal">修改密碼</a></li>

                            @if (Auth::user()->usertype==0)
                                <li><a style="color: black;" href="{{ route('usermanage')}}">帳號管理</a></li>
                            @endif
                            <li><a style="color: black;" class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest

                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
<!-- .navbar-top -->
            <nav class="navbar m-menu navbar-default">
                <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button style="background-color: #a7a7a7; border-radius: 5px;" type="button" class="navbar-toggle collapsed" data-toggle="collapse"data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="client-logo" href="{{ url('/') }}"><img style="width: 210px;" src="{{ asset('img/mis.png') }}" alt=""></a>
                    </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="#navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right main-nav">
                            <li class="active"><a href="{{ url('/') }}">回首頁</a></li>
                            <li><a href="{{ url('/about') }}">關於本系</a></li>
                            <li><a href="{{ url('/teacher') }}">師資介紹</a></li>
                            <li><a href="{{ url('/course') }}">課程及獎學金</a></li>
                            <li><a href="{{ url('/enrollment') }}">招生訊息</a></li>
                            <li class="get-a-quote"><a target="_blank" rel="noopener noreferrer" href="http://prospect.im.mgt.ncu.edu.tw/">未來學生專區</a></li>
                                <li class="get-a-quote"><a href="{{ url('/business') }}">企業導師專區</a></li>
                            <li><a href="{{ url('/activity') }}">活動剪影</a></li>
                <!-- <li class="dropdown dropdown-toggle"><a href="#" data-toggle="dropdown">其他<span><i class="fa fa-angle-down"></i></span></a>
                    <ul class="dropdown-menu">
                            <li><a href="#">未來學生專區</a></li>
                            <li><a href="#">企業導師專區</a></li>
                            <li><a href="#">下載專區</a></li>
                    </ul>
                </li> -->
                

                        </ul>

                    </div>
        <!-- .navbar-collapse -->
                </div>
    <!-- .container -->
            </nav>
<!-- .nav -->




<!-- #my-carousel-->

<div class="container">
            <div class="row" style="padding-bottom: 20px; padding-top: 30px;">
                <div class="col-md-12">
                    <div id="my-carousel" class="carousel slide hero-slide hidden-xs" data-ride="carousel">
                    <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#my-carousel" data-slide-to="1"></li>
                            <li data-target="#my-carousel" data-slide-to="2"></li>
                        </ol>

                    <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="{{asset('img/111.jpg')}}" alt="Hero Slide">
            <!-- <div class="carousel-caption">
                <h1>Strategic Management</h1>

                <p>Efficiently develop parallel e-markets through impactful outsourcing.<br>Conveniently drive prospective functionalities before.</p>
            </div> -->
                            </div>
                            <div class="item">
                                <img src="{{asset('img/hero-slide-2.jpg')}}" alt="...">
                            </div>
                            <div class="item">
                                <img src="{{asset('img/hero-slide-3.jpg')}}" alt="..." >
                            </div>
                        </div>

    <!-- Controls -->
                        <a class="left carousel-control" href="#my-carousel" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#my-carousel" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row" style="padding-bottom: 100px;">    
                <div class="col-sm-9">
                    <div id="selection" align="center">
                        <h2 style="font-family: 微軟正黑體;"><b>公告訊息</b></h2>
                        <h6 style="font-family: 微軟正黑體;">ANNOUNCEMENT</h6>
                    </div>

                    <div class="tab-head" align="center" style="font-family: 微軟正黑體;">
                        <ul class="nav nav-pills welcome-tab-ul">
                            @php ($welcometabtypes = ["最新消息", "招生訊息", "榮譽榜", "課程消息", "工讀與獎學金", "企業導師", "演講訊息", "實習與企業徵才"])
                            <li class="active"><a href="#welcometab0" data-toggle="tab"><b>最新消息</b></a></li>
                            <li><a href="#welcometab1" data-toggle="tab"><b>招生訊息</b></a></li>
                            <li><a href="#welcometab2" data-toggle="tab"><b>榮譽榜</b></a></li>
                            <li><a href="#welcometab3" data-toggle="tab"><b>課程消息</b></a></li>
                            <li><a href="#welcometab4" data-toggle="tab"><b>工讀與獎學金</b></a></li>
                            <li><a href="#welcometab5" data-toggle="tab"><b>企業導師</b></a></li>
                            <li><a href="#welcometab6" data-toggle="tab"><b>演講訊息</b></a></li>
                            <li><a href="#welcometab7" data-toggle="tab"><b>實習與企業徵才</b></a></li>

                        </ul>
                    </div>
                    <br>
                    <div id="tab-content" style="font-family: 微軟正黑體;">
                        @for($counter=0; $counter<8; $counter++)
                            <div class="tab-pane fade{{$counter==0?' in active':''}}" id="{{ 'welcometab'.$counter }}">
                                <table class="content-table welcometab" align="center" id="demo-infor-table">
                                    <thead>
                                        <tr>
                                            <th width="20%">類別</th>
                                            <th width="50%">標題</th>
                                            <th width="10%">附件</th>
                                            <th width="20%">發佈時間</th>
                                        </tr>
                                    </thead>
                                    <tbody id="news-data">

                                        @foreach ($tops->where('top', 'top')->where('category', ($counter == 0 ? '!=' : '=') , $welcometabtypes[$counter]) as $top)
                                        <tr>
                                            <td>{{ $top->category }}</td>
                                            <td><a href="{{ url('homes/'.$top->id.'/post') }}"><span style="color:#4F4F4F;" >{{ $top->title }}</span></a></td>
                                            <td>
                                                @if($top->filename!==NULL)
                                                    <span class="glyphicon glyphicon-file"></span>
                                                @endif
                                            </td>
                                            <td>置頂</td>
                                        </tr>
                                        @endforeach

                                        @foreach ($homes->where('top', null)->where('category', ($counter == 0 ? '!=' : '=') , $welcometabtypes[$counter])->take(15) as $home)
                                            <tr>
                                                <td>{{ $home->category }}</td>
                                                <td><a href="{{ url('homes/'.$home->id.'/post') }}"><span style="color:#4F4F4F;" >{{ $home->title }}</span></a></td>
                                                <td>
                                                    @if($home->filename!==NULL)
                                                        <span class="glyphicon glyphicon-file"></span>
                                                    @endif
                                                </td>
                                                <td>{{date('Y-m-d', strtotime($home->created_at))}}</td>
                                            </tr>
                                        @endforeach 

                                        <tr>
                                            <td colspan="4" style="border: none;">
                                                <br>
                                                <div align="center"><a href="{{ url('/news') }}" id="new-more-button">more >></a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endfor
                        <br>
                        
                    </div>                    
                    <br>
                    @if($auth)
                    <div align="center">
                        <button type="button" id="new-button" data-toggle="modal" data-target="#news_Modal">new</button>
                    </div>
                    @endif
                </div>

                <div class="col-sm-3">
                    <br>
                    <div class="title">榮‧譽‧榜</div>
                    <br>
                    <div id="awards-area">
                        <table width="100%" id="award-table" style="height: 100%;">
                            <tr>
                                <td rowspan="3" width="25%;" style="padding: 5%;"><img src="img/cup.png" width="100%"></td>
                                <td></td>
                            </tr>
                            <tr>

    
                                <td style="font-size: 80%; word-wrap: break-word; width: 10px;">
                                    <a href="{{ url('homes/'.$reward->id.'/post') }}">{{ $reward->title }}</a>
                                </td>
                            </tr>
                        </table>   
                    </div>

                    <br>
                    @if(\Carbon\Carbon::parse(date('Y-m-d', strtotime($home->created_at)))->gt(\Carbon\Carbon::now()))
                    <div class="title">演‧講‧消‧息</div>
                    <br>
                    <div id="speech-area">
                        <table width="100%" id="award-table" style="height: 100%;">
                            <tr>
                                <td rowspan="3" width="25%;" style="padding: 5%;" align="center"><span class="glyphicon glyphicon-calendar" style="font-size: 30px;"></span></td>
                                <td>{{date('Y-m-d', strtotime($speech->created_at))}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ url('homes/'.$speech->id.'/post') }}">{{ $speech->title }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 80%;">{{ $speech->place }}</td>
                            </tr>
                        </table>   
                    </div>
                    @endif

                </div>
            </div>
</div>

                               

<!-- 新增最新消息 -->
<div class="modal fade" id="news_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            新增最新消息
                        </div>
                        <form action="{{ url('home') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="modal-body" align="center">
                            <table id="new_table">
                                <tr>
                                    <td>標題</td>
                                    <td><input type="text" name="title" id="new-title"></td>
                                </tr>
                                <tr>
                                    <td>類別</td>
                                    <td>
                                        <select name="category" id="home-new-homes">
                                            <option value="榮譽榜">榮譽榜</option>
                                            <option value="課程消息">課程消息</option>
                                            <option value="工讀與獎學金">工讀與獎學金</option>
                                            <option value="企業導師">企業導師</option>
                                            <option value="演講訊息">演講訊息</option>
                                            <option value="實習與企業徵才">實習與企業徵才</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div  id="home-new-homes-time">活動時間</div></td>
                                    <td>
                                        <input type="date" name="time" id="new-time"> &nbsp(ex.2018/1/1 00:00)
                                    </td>
                                </tr>
                                <tr>
                                    <td>活動地點</td>
                                    <td>
                                        <input type="text" name="place" id="new-place">
                                    </td>
                                </tr>
                                <tr>
                                    <td>置頂</td>
                                    <td>
                                        <input type="checkbox" name="top" value="top">是
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="new_modal_close2">Close</button>
                            <button type="submit" class="btn btn-primary" id="Save_button">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
</div>






<footer class="footer">



    <div class="copyright-section">
        <div class="container clearfix">
             <span class="copytext">Copyright &copy; 2018 | <a href="{{ url('/') }}">資訊管理學系 Department of Information Management</a> Designed And Developed By: <strong style="color:#4d6de3">Halfmancode</strong></span>           

            <ul class="list-inline pull-right">
                <li><a target="_blank" rel="noopener noreferrer" href="http://im.mgt.ncu.edu.tw/landing/ncuim30/">30 周年系慶活動</a></li>
                <li><a target="_blank" href="https://www.facebook.com/NCUMISclub/">系學會粉絲頁</a></li>
                <li><a target="_blank" href="https://www.facebook.com/ncuimalumni/">系友會粉絲頁</a></li>
                <li><a target="_blank" href="http://140.115.80.30:82/">設備借用系統</a></li>
                <li><a href="/news">最新消息</a></li>
                <li><a href="/honor">榮譽榜</a></li>
                <li><a href="/questionnarie"  target="_blank">問卷調查 </a></li>
            </ul>
        </div><!-- .container -->

    </div><!-- .copyright-section -->
</footer>
<!-- .footer -->

</div>
<!-- .content-wrapper -->
</div>
<!-- .uc-mobile-menu-pusher -->

<div class="uc-mobile-menu uc-mobile-menu-effect">
    <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas"
            id="uc-mobile-menu-close-btn">&times;</button>
    <div>
        <div>
            <ul id="menu">
                <li><a href="{{ url('/') }}">回首頁</a></li>
                <li><a href="{{ url('/about') }}">關於本系</a></li>
                <li><a href="{{ url('/teacher') }}">師資介紹</a></li>
                <li><a href="{{ url('/course') }}">課程及獎學金資訊</a></li>
                <li><a href="{{ url('/enrollment') }}">招生訊息</a></li>
                <li><a href="http://prospect.im.mgt.ncu.edu.tw/">未來學生專區</a></li>
                <li><a href="{{ url('/business') }}"">企業導師專區</a></li>
                <li><a href="{{ url('/activity') }}">活動剪影</a></li>
<!--                 <li class="dropdown dropdown-toggle"><a href="#" data-toggle="dropdown">其他<span><i class="fa fa-angle-down"></i></span></a>
                    <ul class="dropdown-menu">
                            <li><a href="#">未來學生專區</a></li>
                            <li><a href="#">企業導師專區</a></li>
                            <li><a href="#">下載專區</a></li>
                    </ul>
                </li> -->
                {{-- <li><a href="#">登入</a></li> --}}
                @guest
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">登入</a></li>
                @else
                    <li class="dropdown dropdown-toggle"><a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li><a id="drop" href="#" data-toggle="modal" data-target="#changeusernamepassword-modal">修改帳號密碼</a></li>

                            @if (Auth::user()->usertype==0)
                                <li><a id="drop" href="{{ route('usermanage')}}">帳號管理</a></li>
                            @endif
                            <li><a id="drop" class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</div>
<!-- .uc-mobile-menu -->

</div>
<!-- #main-wrapper -->

{{-- Login Modal --}}
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>

            @if (count($errors) > 0)
                <div class="alert alert-danger" id="errordiv">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
            

          <form name="modal-form" method="POST" action="{{ route('login') }}" >
            @csrf
            <input type="text" placeholder="Username" name="username" value="{{ old('username') }}" required>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>
            
          {{-- <div class="login-help">
            <a href="#">Register</a> - <a href="#">Forgot Password</a>
          </div> --}}
        </div>
    </div>
</div>  
{{-- Login Modal --}}

@guest
@else
{{-- changeusernamepassword Modal --}}
<div class="modal fade" id="changeusernamepassword-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Change Your Password</h1><br>

            @if ($errors->has('passwordchanged'))
                <div class="alert alert-danger" id="errordiv">
                    {!! implode('<br>', $errors->all()) !!}
                </div>
            @endif
            

          <form name="modal-form" method="POST" action="{{ route('changeusernamepassword') }}" >
            @csrf
            <input type="text" placeholder="Username" name="username" value="{{ Auth::user()->username }}" required>
            <input type="password" placeholder="Password" name="passwordchanged" required>
            <input type="password" placeholder="Confirm Password" name="passwordchanged_confirmation" required>
            <input type="submit" name="login" class="login loginmodal-submit" value="Reset">

          </form>
        </div>
    </div>
</div>  
{{-- changePassword Modal --}}
@endguest

<!-- Script -->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/mobile-menu.js"></script>
<script src="js/scripts.js"></script>
<script type="text/javascript" src="{{ URL::asset('/js/home.js') }}"></script>

<script language="JavaScript" type="text/javascript"> 

    @if ($errors->has('passwordchanged'))
        $('#changeusernamepassword-modal').modal('show');
    @elseif (session()->has('msg'))
        $('#login-modal').modal('show');
    @endif



    
</script>

</body>
</html>
