@extends('master')

@section('content')
	{{Form::open(array('url'=>'user/list'))}}
		{{Form::hidden('id', $user->id)}}
		<label>{{$user->Name}}</label>
		{{Form::hidden('user_name',$user->Name)}}
		<br>
		<input type="text" name="phone" value={{$user->Phone}}>
		<br>
		<input type="text" name="center" list="center_list" value={{$user->center->id}}>
		<datalist id="center_list">
			<?php
				$centers=Center::all();
				foreach ($centers as $center) {
					echo "<option label=".$center->CenterName." value=".$center->id."></option>";
				}
			?>
		</datalist>
		<br>
		<?php
			$roles=Role::all();
			foreach ($roles as $role) {
				$userroles=$user->roles;
				$bool=false;
				foreach ($userroles as $userrole) {
					if($userrole->id==$role->id){
						$bool=true;
					}
				}
				echo Form::checkbox('role[]', $role->id,$bool);
				echo $role->RoleName;
			}
		?>
		<br>
		{{Form::checkbox('reset', 'reset')}}重置密码
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
	
@stop