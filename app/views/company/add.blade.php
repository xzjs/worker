@extends('master')

@section('content')
	{{Form::open(array('url'=>'company/list'))}}
		<input type="text" name="company_name" required="required" placeholder="请输入公司名称">
		
		{{Form::submit('确定')}}
	{{Form::close()}}
	
@stop