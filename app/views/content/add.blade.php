@extends('master')

@section('content')
	{{Form::open(array('url'=>'content/add'))}}
		{{Form::textarea ('chaircontent');}}
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop