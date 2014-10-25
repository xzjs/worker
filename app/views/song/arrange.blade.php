@extends('master')

@section('content')
	<table class="table  table-striped table-bordered table-hover">
		<thead>
			<th>时间</th>
			<th>诗歌</th>
			<th></th>
		</thead>
		<tbody>
			<?php
				$songs=Song::all();
			?>
			@foreach($songs as $song)
			<tr>
				<td>{{$song->time}}</td>
				<td>{{$song->content}}</td>
				<td>
					<a href="add/{{$song->id}}">修改</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		<p>
		<a href="add">添加新的诗歌</a>
		</p>
		
	</div>
@stop