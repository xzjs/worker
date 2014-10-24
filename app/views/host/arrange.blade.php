@extends('master')

@section('content')
	{{Form::open(array('url'=>'host/arrange'))}}
	{{Form::hidden('return_view','host.arrange')}}
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
						$activity=Activity::where('center_id','=',$center->id)->where('Date','=',date("Ymd", $sunday))->first();
						if($activity!=null){
							$chair=$activity->chair;
							if($activity->center_id== Auth::user()->center_id){
								echo "<td ondrop='drop(event)' ondragover='allowDrop(event)' style='background-color: rgb(0,255,255)' id=".$chair->id." >";
								if($chair->host_id!=null){
									$user=User::find($chair->host_id);
									echo "<button onclick=predel('".$chair->id."') id=".$chair->id.">".$user->Name."</button>";
								}
							}else{ 
								echo "<td>";
								//echo $user->id."+".Auth::id();
							}	
						}else{
							echo "<td>";
						}
						echo "</td>";
					}
				?>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div>
		<p>
		<?php
			$users= Role::find(4)->users;
			foreach ($users as $user) {
				echo '<button draggable="true" ondragstart="drag(event)" id="'.$user->id.'">'.$user->Name.'</button>';
			}
		?>
		</P>
	</div>
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

		function add(chairid,contentid){
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null){
  				alert ("Browser does not support HTTP Request")
  				return
  			} 
			var url="addToChair/"
			url=url+chairid+"/"+contentid
			//url=url+"&sid="+Math.random()	
			//xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,false)
			xmlHttp.send(null) 
			//window.location.href=url;
		}

		function del(chairid){
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null){
  				alert ("Browser does not support HTTP Request")
  				return
  			} 
			var url="delToChair/"
			url=url+chairid
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

  		function contentDel(contentid){
  			$("button#"+contentid).remove();
  			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null){
  				alert ("Browser does not support HTTP Request")
  				return
  			} 
			var url="content/del/"
			url=url+contentid
			//url=url+"&sid="+Math.random()	
			//xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,false)
			xmlHttp.send(null) 
			//window.location.href=url;
  		}
	</script>
	
@stop