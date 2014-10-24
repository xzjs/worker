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
		<a href="add">添加新的公司</a>
	{{Form::close()}}
	
@stop