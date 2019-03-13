<div class="row">

    <div class="col-sm-2"></div>

    <div class="col-sm-10">

        <ul id="myTab" class="nav nav-pills mb-3">

            <li class="dropdown">
                <a class="nav-link active" id="pills-c-tab" href="#pills-c" role="tab" aria-controls="pills-c" aria-selected="true" ><span style="color:#696969;">招生訊息</span>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/enrollment') }}">公告</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="nav-link active" id="pills-b-tab" href="#pills-b" role="tab" aria-controls="pills-b" aria-selected="true"><span style="color:#696969;">學士班</span>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/enrollment/BS/BSapply') }}">個人申請</a></li>
                    <li><a href="{{ url('/enrollment/BS/BStest') }}">考試入學分發</a></li>
                    <li><a href="{{ url('/enrollment/BS/BSstar') }}">繁星推薦</a></li>
                    <li><a href="{{ url('/enrollment/BS/BSsport') }}">運動績優甄試</a></li>
                    <li><a href="{{ url('/enrollment/BS/BSother') }}">其他入學招生</a></li>   
                </ul>
            </li>

            <li class="dropdown">
                <a class="nav-link active" id="pills-c-tab" href="#pills-c" role="tab" aria-controls="pills-c" aria-selected="true"><span style="color:#696969;">碩士班</span>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/enrollment/MS/MSselect') }}">甄試入學</a></li>
                    <li><a href="{{ url('enrollment/MS/MSexam') }}">考試入學</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="nav-link active" id="pills-d-tab" href="#pills-d" role="tab" aria-controls="pills-d" aria-selected="true"><span style="color:#696969;">碩士在職專班</span>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/enrollment/EMS/EMSexam') }}">考試入學</a></li>
                    <li><a href="{{ url('/enrollment/EMS/EMScredit') }}">碩士在職專班學分班</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="nav-link active" id="pills-d-tab" href="#pills-d" role="tab" aria-controls="pills-d" aria-selected="true"><span style="color:#696969;">博士班</span>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/enrollment/PhD/PhDselect') }}">甄試入學</a></li>
                    <li><a href="{{ url('/enrollment/PhD/PhDexam') }}">考試入學</a></li>
                </ul>
            </li>

        </ul>

        <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade" id="b1">
                <p>這是學士班的個人申請</p>
            </div>

            <div class="tab-pane fade" id="c1">
                <p>這是碩士班的甄試入學</p>
            </div>

        </div>

    </div>

</div>