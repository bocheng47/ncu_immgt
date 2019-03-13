{{-- Vertical navbar start --}}
<!-- <div class="col-sm-3 col-sm-pull-9 sidebarStyle">
	<div class="text-xs-center text-sm-left ">			
		<ul class="nav nav-pills nav-stacked">
			<li><a target="_blank" rel="noopener noreferrer" href="https://cis.ncu.edu.tw/Course/main/query/byUnion?dept=deptI1I4003I0"><span class="glyphicon glyphicon-list-alt"></span>  課程大綱</a></li>
			<li class="{{ Request::is('course/rule') ? 'active' : '' }}"><a href="{{ url('/course/rule') }}"><span class="glyphicon glyphicon-education"></span>  修業規定</a></li>
			<li class="{{ Request::is('course/double') ? 'active' : '' }}"><a href="{{ url('/course/double') }}"><span class="glyphicon glyphicon-plane"></span>  雙聯學位計畫</a></li>
			<li class="{{ Request::is('course/waiver') ? 'active' : '' }}"><a href="{{ url('/course/waiver') }}"><span class="glyphicon glyphicon-resize-horizontal"></span>  抵免辦法</a></li>
			<li class="{{ Request::is('course/program') ? 'active' : '' }}"><a href="{{ url('/course/program') }}"><span class="glyphicon glyphicon-briefcase"></span>  學分學程</a></li>
			<li class="{{ Request::is('course/paperrule') ? 'active' : '' }}"><a href="{{ url('/course/paperrule') }}"><span class="glyphicon glyphicon-list"></span>  研究所學位論文規定</a></li>
			<li class="{{ Request::is('course/goodpaper') ? 'active' : '' }}"><a href="{{ url('/course/goodpaper') }}"><span class="glyphicon glyphicon-star-empty"></span>  優秀畢業論文</a></li>
			<li class="{{ Request::is('course/scholarship') ? 'active' : '' }}"><a href="{{ url('/course/scholarship') }}"><span class="glyphicon glyphicon-usd"></span>  學生獎學金辦法</a></li>
		</ul>
	</div>
</div>
 -->
<div class="col-sm-3 sidebarStyle" style="padding-top: 30px;">
	<div style="padding-left: 60px;">
      <ul>
        <li class="sidebar_link"><a href="https://cis.ncu.edu.tw/Course/main/query/byUnion?dept=deptI1I4003I0" class="link"><span class="glyphicon glyphicon-list-alt"></span>&nbsp課程大綱</a></li>
        <li class="sidebar_link {{ Request::is('course/rule') ? 'active' : '' }}"><a href="{{ url('/course/rule') }}" class="link"><span class="glyphicon glyphicon-education"></span>&nbsp修業規定</a></li>
        <li class="sidebar_link {{ Request::is('course/double') ? 'active' : '' }}"><a href="{{ url('/course/double') }}" class="link"><span class="glyphicon glyphicon-plane"></span>&nbsp雙聯學位計畫</a></li>
        <li class="sidebar_link {{ Request::is('course/waiver') ? 'active' : '' }}"><a href="{{ url('/course/waiver') }}" class="link"><span class="glyphicon glyphicon-resize-horizontal"></span>&nbsp抵免辦法</a></li>
        <li class="sidebar_link {{ Request::is('course/program') ? 'active' : '' }}"><a href="{{ url('/course/program') }}" class="link"><span class="glyphicon glyphicon-briefcase"></span>&nbsp學分學程</a></li>
        <li class="sidebar_link {{ Request::is('course/paperrule') ? 'active' : '' }}"><a href="{{ url('/course/paperrule') }}" class="link"><span class="glyphicon glyphicon-list"></span>&nbsp研究所學位論文規定</a></li>
        <li class="sidebar_link {{ Request::is('course/goodpaper') ? 'active' : '' }}"><a href="{{ url('/course/goodpaper') }}" class="link"><span class="glyphicon glyphicon-star-empty"></span>&nbsp優秀畢業論文</a></li>
        <li class="sidebar_link {{ Request::is('course/scholarship') ? 'active' : '' }}"><a href="{{ url('/course/scholarship') }}" class="link"><span class="glyphicon glyphicon-usd"></span>&nbsp學生獎學金辦法</a></li>
      </ul>
    </div>
</div>
{{-- Vertical navbar end --}}
