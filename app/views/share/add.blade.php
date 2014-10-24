@extends('master')

@section('content')
	{{Form::open(array('url'=>'share/add'))}}
		<?php
			echo Form::hidden('share_id', $id);
			if($id==0){
				echo Form::textarea ('sharecontent');	
			}else{
				$share=Share::find($id);
				echo Form::textarea('sharecontent', $share->content);
			}
		?>
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop