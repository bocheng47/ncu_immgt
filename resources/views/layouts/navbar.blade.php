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
                                <li class="get-a-quote"><a href="http://im.mgt.ncu.edu.tw/english/01/main.php" title="" target="_blank">English</a></li>
                                <li class="get-a-quote"><a target="_blank" rel="noopener noreferrer" href="https://www.ncu.edu.tw/" title="">中大首頁</a></li>

                                            {{-- <li><a href="#">登入</a></li> --}}
                @guest
                    <li class="get-a-quote"><a href="#" data-toggle="modal" data-target="#login-modal">登入</a></li>
                @else
                    <li class="get-a-quote nav-link dropdown dropdown-toggle"><a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name == null ? \App\Teacher::find( Auth::user()->teacher_id)->name." 老師"  : Auth::user()->name }} <span class="caret"></span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li><a style="color: black;" href="#" data-toggle="modal" data-target="#changeusernamepassword-modal">修改帳號密碼</a></li>

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
                <div class="collapse navbar-collapse" id="#navbar-collapse-1" style="font-family: 微軟正黑體;">
                    <ul class="nav navbar-nav navbar-right main-nav">
                        <li><a href="{{ url('/') }}">回首頁</a></li>
                        <li {{(Request::is('about/*')||Request::is('about')?'class=active':'') }}><a href="{{ url('/about') }}">關於本系</a></li>
                        <li {{(Request::is('teacher/*')||Request::is('teacher')?'class=active':'') }}><a href="{{ url('/teacher') }}">師資介紹</a></li>
                        <li {{(Request::is('course/*')||Request::is('course')?'class=active':'') }}><a href="{{ url('/course') }}">課程及獎學金</a></li>
                        <li {{(Request::is('enrollment/*')||Request::is('enrollment')?'class=active':'') }}><a href="{{ url('/enrollment') }}">招生訊息</a></li>
                        <li class="get-a-quote"><a target="_blank" rel="noopener noreferrer" href="http://prospect.im.mgt.ncu.edu.tw/">未來學生專區</a></li>
                            <li class="get-a-quote"><a href="{{ url('/business') }}">企業導師專區</a></li>
                        <li {{(Request::is('activity/*')||Request::is('activity')?'class=active':'') }}><a href="{{ url('/activity') }}">活動剪影</a></li>
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