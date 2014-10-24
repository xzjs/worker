@extends('master')

@section('content')
	{{Form::open(array('url'=>'song/add'))}}
		{{Form::textarea ('songcontent');}}
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop