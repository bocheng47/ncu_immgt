@extends('app5')
@section('content')
<!-- 主畫面 -->
<section class="container">
    <form action="{{ url('news/'.$home->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
            <div class="modal-body" align="center">
                <table id="new_table">
                    <tr>
                        <td>
                            <font face="monospace" size="5">標題</font>
                        </td>
                        <td><input type="text" name="title" id="new-title" value="{{ $home->title}}"></td>
                    </tr>
                    <tr>
                        <td>
                            <font face="monospace" size="5">類別</font>
                        </td>
                        <td>
                            <select name="category">
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
                        <td>
                            <font face="monospace" size="5">{{ $home->category=="演講訊息" ? "過期" : "活動"}}時間</font>
                        </td>
                        <td>
                            <input type="date" name="time" id="new-time" value="{{date('Y-m-d', strtotime($home->created_at))}}"> &nbsp(ex.2018/1/1 00:00)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font face="monospace" size="5">活動地點</font>
                        </td>
                        <td>
                            <input type="text" name="place" id="new-place" value="{{ $home->place}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <font face="monospace" size="5">置頂</font>
                        </td>
                        <td>
                            <input type="checkbox" name="top" value="{{ $home->top}}">是
                        </td>
                    </tr>
                    <tr>
                </table>
            <input type="submit" value="送出" class="btn btn-primary">
            </div>
    </form>
</section>
@stop