@extends('master')

@section('content')
	{{Form::open(array('url'=>'user/list'))}}
		
		<input type="text" name="user_name" required="required" placeholder="请输入员工姓名">
		<br>
		<input type="tel" name="phone"  required="required" placeholder="请输入电话号码" >
		{{ $errors->first('phone', '<p class="error">:message</p>') }}
		<br>	
		<?php
			$centers=Center::all();
			echo '<select name="center">';
			foreach ($centers as $center) {
				echo "<option value='".$center->id."'>".$center->CenterName."</option>";
			}
			echo "</select>";
		?>
		<br>
		<?php
			$roles=Role::all();
			foreach ($roles as $role) {
				echo Form::checkbox('role[]', $role->id);
				echo $role->RoleName;
			}
		?>
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
	
@stop