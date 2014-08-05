@extends('master')

@section('content')
	<table class="table table-striped table-bordered bootstrap-datatable">
		<thead>
			<tr>
				<th></th>
				<th>金花园（上）</th>
				<th>金花园（下）</th>
				<th>银</th>
				<th>宝石</th>
				<th>翡翠</th>
				<th>恩惠</th>
				<th>伯大尼</th>
				<th>援外</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>5-4</td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td11"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td12"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td13"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td14"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td15"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td16"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td17"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td18"></td>
			</tr>
			<tr>
				<td>5-4</td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td21"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td22"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td23"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td24"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td25"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td26"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td27"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td28"></td>
			</tr>
			<tr>
				<td>5-4</td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td31"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td32"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td33"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td34"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td35"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td36"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td37"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td38"></td>
			</tr>
			<tr>
				<td>5-4</td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td41"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td42"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td43"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td44"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td45"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td46"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td47"></td>
				<td ondrop="drop(event)" ondragover="allowDrop(event)" id="td48"></td>
			</tr>
		</tbody>
	</table>
	<div>
		<button draggable="true" ondragstart="drag(event)" id="b1">熊</button>
		<button draggable="true" ondragstart="drag(event)" id="b2">红</button>
		<button draggable="true" ondragstart="drag(event)" id="b3">黄</button>
		<button draggable="true" ondragstart="drag(event)" id="b4">蓝</button>
		<button draggable="true" ondragstart="drag(event)" id="b5">绿</button>
	</div>
	<script type="text/javascript">
		function allowDrop(ev)
		{
			ev.preventDefault();
		}

		function drag(ev)
		{
			ev.dataTransfer.setData("Text",ev.target.id);
		}

		function drop(ev)
		{
			ev.preventDefault();
			var data=ev.dataTransfer.getData("Text");
			var btn1=document.getElementById(data).cloneNode(true);
			ev.target.appendChild(btn1);
			btn1.onclick=function(){
				btn1.remove();
			}
		}


</script>
	
@stop