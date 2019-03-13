@extends('appforquestionnarie')

@section('content')

<section class="container">
	<form action="{{ url('questionnarie') }}" method="post">
		@csrf
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table class="table table-dark">
			<tr>
				問卷標題:<input type="string" name="title" class="form-control"  style="width:200px;height:30px;" required="required">
			</tr>
			<tr>
				<td>
					部別:<input type="string" name="class1" class="form-control" style="width:100px;height:30px;">
				</td>
				<td>	
					表單連結:<input type="string" name="hreftocollege" class="form-control" style="width:200px;height:30px;">
				</td>
			</tr>

			<tr>	
				<td>
					部別:<input type="string" name="class2" class="form-control" style="width:100px;height:30px;">
				</td>	
				<td>	
					表單連結:<input type="string" name="hreftoms" class="form-control" style="width:200px;height:30px;">
				</td>
			</tr>
				<td>	
					部別:<input type="string" name="class3" class="form-control" style="width:100px;height:30px;">
				</td>	
				<td>	
					表單連結:<input type="string" name="hreftophd" class="form-control" style="width:200px;height:30px;">
				</td>
			</tr>
			<tr>	
				<td>
					部別:<input type="string" name="class4" class="form-control" style="width:100px;height:30px;">
				</td>	
				<td>	
					表單連結:<input type="string" name="hreftoemba" class="form-control" style="width:200px;height:30px;">
				</td>
			</tr>
		</table>
			<input type=submit value="新增" class="btn btn-primary">
	</form>
</section> 

@stop