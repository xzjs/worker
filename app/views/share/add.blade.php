@extends('master')

@section('content')
	{{Form::open(array('url'=>'share/add'))}}
		{{Form::textarea ('sharecontent');}}
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop