<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- off-canvas -->
    <link href="{{ URL::asset('css/mobile-menu.css') }}" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">    
    <!-- Flat Icon -->
    <link href="{{ URL::asset('fonts/flaticon/flaticon.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div id="main-wrapper">
<!-- Page Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>

    <div class="uc-mobile-menu-pusher">
    <div class="content-wrapper">

        @include('layouts.navbar')
        <section class="single-page-title single-page-title-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p id="main_title"> @yield('title')</p>
                    </div>
                </div>
            </div>
        </section>
        @yield('content')

        @include('layouts.footer')
    </div>
    <!-- .content-wrapper -->
    </div>
    <!-- .uc-mobile-menu-pusher -->

<div class="uc-mobile-menu uc-mobile-menu-effect">
    <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="uc-mobile-menu-close-btn">&times;</button>
    <div>
        <div>
            <ul id="menu">
                <li><a href="{{ url('/') }}">回首頁</a></li>
                <li><a href="{{ url('/about') }}">關於本系</a></li>
                <li><a href="{{ url('/course') }}">課程及獎學金資訊</a></li>
                <li><a href="{{ url('/enrollment') }}">招生訊息</a></li>
                <li><a href="{{ url('/http://deptmember.im.mgt.ncu.edu.tw/01/main.php') }}">系友專區</a></li>
                <li><a href="{{ url('/activity') }}">活動剪影</a></li>
                <!-- <li class="dropdown dropdown-toggle"><a href="#" data-toggle="dropdown">其他<span><i class="fa fa-angle-down"></i></span></a>
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
                            <li><a href="#" data-toggle="modal" data-target="#changeusernamepassword-modal">修改密碼</a></li>

                            @if (Auth::user()->usertype==0)
                                <li><a href="{{ route('usermanage')}}">帳號管理</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
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
<div class="uc-mobile-menu uc-mobile-menu-effect">
    <button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="uc-mobile-menu-close-btn">&times;</button>
    <div>
        <div>
            <ul id="menu">
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
                {{-- <li><a href="#">登入</a></li> --}}
                @guest
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">登入</a></li>
                @else
                    <li class="dropdown dropdown-toggle"><a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#changeusernamepassword-modal">修改帳號密碼</a></li>

                            @if (Auth::user()->usertype==0)
                                <li><a href="{{ route('usermanage')}}">帳號管理</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
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
            <h1>Change Your Info</h1><br>

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

</div>
<!-- #main-wrapper -->


<!-- Script -->
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/smoothscroll.js') }}"></script>
<script src="{{ URL::asset('js/mobile-menu.js') }}"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>
<script type="text/javascript">
    $('.modal').on('show.bs.modal', function() {
        // prevent modal appear under background
        $(this).appendTo("body");
    })
    @if ($errors->has('passwordchanged'))
        $('#changeusernamepassword-modal').modal('show');
    @elseif (session()->has('msg'))
        $('#login-modal').modal('show');
    @endif
</script>
@yield('js')
</body>
</html>
{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- off-canvas -->
    <link href="{{ URL::asset('css/mobile-menu.css') }}" rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">    
    <!-- Flat Icon -->
    <link href="{{ URL::asset('fonts/flaticon/flaticon.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Style CSS -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div id="main-wrapper">
<!-- Page Preloader -->
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>

    <div class="uc-mobile-menu-pusher">
    <div class="content-wrapper">

        @include('layouts.navbar')
        <section class="single-page-title single-page-title-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@yield('title')</h2>
                    </div>
                </div>
            </div>
        </section>
        @yield('content')

        @include('layouts.footer')
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
                <li><a href="{{ url('/course') }}">課程及獎學金資訊</a></li>
                <li><a href="{{ url('/enrollment') }}">招生訊息</a></li>
                <li><a href="{{ url('/http://deptmember.im.mgt.ncu.edu.tw/01/main.php') }}">系友專區</a></li>
                <li><a href="{{ url('/activity') }}">活動剪影</a></li>
                <!-- <li class="dropdown dropdown-toggle"><a href="#" data-toggle="dropdown">其他<span><i class="fa fa-angle-down"></i></span></a>
                    <ul class="dropdown-menu">
                            <li><a href="#">未來學生專區</a></li>
                            <li><a href="#">企業導師專區</a></li>
                            <li><a href="#">下載專區</a></li>
                    </ul>
                </li> -->
                <li><a href="#">登入</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- .uc-mobile-menu -->
<div class="uc-mobile-menu uc-mobile-menu-effect">
<button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="uc-mobile-menu-close-btn">&times;</button>
<div>
    <div>
        <ul id="menu">
            <li><a href="{{ url('/') }}">回首頁</a></li>
                <li><a href="{{ url('/about') }}">關於本系</a></li>
                <li><a href="{{ url('/teacher') }}">師資介紹</a></li>
                <li><a href="{{ url('/enrollment') }}">課程及獎學金資訊</a></li>
                <li><a href="{{ url('/course') }}">招生訊息</a></li>
                <li><a href="{{ url('/http://deptmember.im.mgt.ncu.edu.tw/01/main.php') }}">系友專區</a></li>
                <li><a href="{{ url('/activity') }}">活動剪影</a></li>
                <!-- <li class="dropdown dropdown-toggle"><a href="#" data-toggle="dropdown">其他<span><i class="fa fa-angle-down"></i></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">未來學生專區</a></li>
                        <li><a href="#">企業導師專區</a></li>
                        <li><a href="#">下載專區</a></li>
                    </ul>
                </li> -->
                <li><a href="#">登入</a></li>
        </ul>
    </div>
</div>
</div>
<!-- .uc-mobile-menu -->                

</div>
<!-- #main-wrapper -->


<!-- Script -->
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>

<script src="{{ URL::asset('js/smoothscroll.js') }}"></script>
<script src="{{ URL::asset('js/mobile-menu.js') }}"></script>
<script src="{{ URL::asset('js/scripts.js') }}"></script>

@yield('js')
</body>
</html>
 --}}
