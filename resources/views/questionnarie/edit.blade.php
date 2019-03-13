@extends('appforquestionnarie')

@section('content')

<section class="container">
	<form action="{{ url('questionnarie/'.$query->id) }}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PUT">
		@csrf
		
		<font face="monospace" size="5">標題</font>
		<input type="string" name="title" class="form-control" value="{{ $query->title }}" style="width:300px;height:30px;" required="required">
		<br>
		<table class="table table-dark">
		<tr>
			<td>
				<font face="monospace" size="5">部別:</font>
				<input type="string" name="class1" class="form-control" value="{{ $query->class1 }}" style="width:100px;height:30px;">
			</td>
			<td>
				<font face="monospace" size="5">表單連結:</font>
				<input type="string" name="hreftocollege" class="form-control" value="{{ $query->hreftocollege}}" style="width:200px;height:30px;">
			</td>
		</tr>
		<tr>
			<td>
				<font face="monospace" size="5">部別:</font>
				<input type="string" name="class2" class="form-control" value="{{ $query->class2 }}" style="width:100px;height:30px;">
			</td>
			<td>
				<font face="monospace" size="5">表單連結:</font>
				<input type="string" name="hreftoms" class="form-control" value="{{ $query->hreftoms}}" style="width:200px;height:30px;">
			</td>
		</tr>
		<tr>
			<td>
				<font face="monospace" size="5">部別:</font>
				<input type="string" name="class3" class="form-control" value="{{ $query->class3 }}" style="width:100px;height:30px;">
			</td>
			<td>
				<font face="monospace" size="5">表單連結:</font>
				<input type="string" name="hreftophd" class="form-control" value="{{ $query->hreftophd }}" style="width:200px;height:30px;">
			</td>
		</tr>
		<tr>
			<td>
				<font face="monospace" size="5">部別:</font>
				<input type="string" name="class4" class="form-control" value="{{ $query->class4 }}" style="width:100px;height:30px;">
			</td>
			<td>
				<font face="monospace" size="5">表單連結:</font>
				<input type="string" name="hreftoemba" class="form-control" value="{{ $query->hreftoemba}}" style="width:200px;height:30px;">
			</td>
		</tr>
	</table>
		<input type="submit" value="送出" class="btn btn-primary">
	</form>	
</section>

@stop
