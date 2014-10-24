@extends('master')

@section('content')
	<table class="table  table-striped table-bordered table-hover">
		<thead>
			<th>时间</th>
			<th>家事分享1</th>
			<th></th>
		</thead>
		<tbody>
			<?php
				$shares=Share::all();
			?>
			@foreach($shares as $share)
			<tr>
				<td>{{$share->time}}</td>
				<td>{{$share->content}}</td>
				<td>
					<a href="share/add/{{$share->id}}">修改</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		<p>
		<a href="add">添加新家事分享</a>
		</p>
	</div>
@stop