@extends('master')

@section('content')
	{{Form::open(array('url'=>'share/add'))}}
		<?php
			if($id==0){
		?>
				{{Form::textarea ('sharecontent');}}		
		<?php
			}else{
				$share=Share::
			}
		?>
		 
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop