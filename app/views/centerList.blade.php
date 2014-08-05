@extends('master')

@section('content')
	{{Form::open(array('url'=>'centerList'))}}
		<table class="table table-striped table-bordered bootstrap-datatable">
			<tbody>
				@foreach($centers as $center)
					<tr>
						<td>{{$center->CenterName}}</td>
						<td>{{HTML::link('center/delete/'.$center->id,'删除')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		

		
	{{Form::close()}}
	
@stop