@extends('master')

@section('content')
	{{Form::open(array('url'=>'centerList'))}}
		<input type="text" name="center_name" required="required" placeholder="请输入培训中心名称">
		<br>
		<input type="text" name="company_id" list="company_list">
		<datalist id="company_list">
			@foreach($companies as $company)
				<option label={{$company->CompanyName}} value={{$company->id}}></option>
			@endforeach
		</datalist>
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop