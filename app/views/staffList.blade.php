@extends('master')

@section('content')
	{{Form::open(array('url'=>'centerList'))}}
		<table class="table table-striped table-bordered bootstrap-datatable">
			<tbody>
				@foreach($staffs as $staff)
					<tr>
						<td>{{$staff->Name}}</td>
						<td>{{$staff->phone}}</td>
						<td>{{$staff->center->CenterName}}</td>
						<td>{{$staff->role->RoleName}}</td>
						<td>{{HTML::link('staff/delete/'.$staff->id,'删除')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		

		
	{{Form::close()}}
	
@stop