@extends('master')

@section('content')

	{{Form::open(array('url'=>'companyList'))}}
		<table class="table table-striped table-bordered bootstrap-datatable">
			
			<tbody>
				@foreach($companies as $company)
					<tr>
						<td>{{$company->CompanyName}}</td>
						<td>{{HTML::link('company/delete/'.$company->id,'删除')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
	{{Form::close()}}
	
@stop