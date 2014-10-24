@extends('master')

@section('content')
	{{Form::open(array('url'=>'userList'))}}
		<table class="table table-striped table-bordered bootstrap-datatable">
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user->Name}}</td>
						<td>{{$user->Phone}}</td>
						<td>
							<?php
								$roles=User::find($user->id)->roles;
								foreach ($roles as $role) {
									echo $role->RoleName." ";
								}
							?>
						</td>
						<td>{{HTML::link('user/edit/'.$user->id,'编辑')}}</td>
						<td>{{HTML::link('user/delete/'.$user->id,'删除')}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<a href="add">添加新的员工</a>
	{{Form::close()}}
@stop