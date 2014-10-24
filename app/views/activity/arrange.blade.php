@extends('master')

@section('content')
	{{Form::open(array('url'=>'activity/arrange'))}}
	{{Form::hidden('return_view','activity.arrange')}}
	<input type="month" name="user_date" />
	{{Form::submit('提交')}}
	<table class="table table-striped table-bordered bootstrap-datatable">
		<thead>
			<tr>
				<th></th>
				<?php
					$centers=Center::all();
					foreach ($centers as $Center) {
						echo "<th>".$Center->CenterName."</th>";
					}
				?>
			</tr>
		</thead>
		<tbody>
			@foreach($sundays as $sunday)
			<tr>
				<td>{{date("Y-m-d", $sunday)}}</td>
				<?php
					$centers=Center::all();
					foreach ($centers as $center) {
						echo '<td ondrop="drop(event)" ondragover="allowDrop(event)" id="'.date("Ymd", $sunday)."a".$center->id.'" >';
						$activity=Activity::where('center_id','=',$center->id)->where('Date','=',date("Ymd", $sunday))->first();
						if($activity!=null){
							$chair=$activity->chair;
							$user=User::find($chair->teacher_id);
							$btnid=date("Ymd", $sunday)."a".$center->id."a".$user->id;
							echo "<button draggable='true' ondragstart='drag(event)' id='".$btnid."' onclick=predel('$btnid')>".$user->Name."</button>";
						}
						echo "</td>";
					}
				?>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		<?php
			$users= Role::find(1)->users;
			foreach ($users as $user) {
				echo '<button draggable="true" ondragstart="drag(event)" id="'.$user->id.'">'.$user->Name.'</button>';
			}
		?>
	</div>
	{{ Form::close() }}
	<script type="text/javascript">
		function predel(var1){
			$("button#"+var1).remove();
			del(var1);
		}

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
			btn1.id=ev.target.id+"+"+data;
			ev.target.appendChild(btn1);
			btn1.onclick=function(){
				del(btn1.id);
				btn1.remove();
			}
			add(ev.target.id,data);
		}

		function add(centerdate,people){
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null){
  				alert ("Browser does not support HTTP Request")
  				return
  			} 
			var url="add"
			url=url+"/"+centerdate+"/"+people
			//url=url+"&sid="+Math.random()	
			//xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,true)
			xmlHttp.send(null) 
			//window.location.href=url;
		}

		function del(centerdatepeople){
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null){
  				alert ("Browser does not support HTTP Request")
  				return
  			} 
			var url="delete/"
			url=url+centerdatepeople
			xmlHttp.open("GET",url,true)
			xmlHttp.send(null) 
			//window.location.href=url
		}

		function GetXmlHttpObject(){
			var xmlHttp=null;
			try{
 				// Firefox, Opera 8.0+, Safari
 				xmlHttp=new XMLHttpRequest();
 			}
			catch (e)
 			{
 				// Internet Explorer
 				try{
  					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  				}
 				catch (e){
  					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
  			}
  			return xmlHttp;
  		}
</script>
	
@stop