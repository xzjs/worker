@extends('master')

@section('content')
	{{Form::open(array('url'=>'index'))}}
	{{Form::hidden('return_view','index')}}
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
						/*echo $center->id.'+'.date("Ymd", $sunday);
						echo '<br>';*/
						if($activity!=null){
							echo "<td>";

							$chair=$activity->chair;
							if($chair->teacher_id!=null){
								$user=User::find($chair->teacher_id);
								echo "<button class='btn btn-primary btn-lg' data-toggle='modal' data-target='#".$activity->id."'>".$user->Name."</button>";
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
<?php
$activities=Activity::all();
foreach ($activities as $activity) {
	$chair=$activity->chair;
	echo "<div class='modal fade' id='".$activity->id."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'><div class='modal-body'>";
	if($chair->teacher_id!=null){
		$teacher=User::find($chair->teacher_id);
		echo "<h4>讲师</h4>";
		echo "<p>".$teacher->Name."</p>";
	}
	if($chair->content_id!=null){
		echo "<h4>证道内容</h4>";
		echo "<p>".$chair->content->text."</p>";
	}
	if($chair->share_id!=null){
		echo "<h4>家事分享</h4>";
		echo "<p>".$chair->share->content."</p>";
	}
	if($chair->host_id!=null){
		$host=User::find($chair->host_id);
		echo "<h4>主持人</h4>";
		echo "<p>".$host->Name."</p>";
	}
	if($chair->song_id!=null){
		
		echo "<h4>诗歌</h4>";
		echo "<p>".$chair->song->content."</p>";
	}
	echo "</div></div>";
}
	
?>

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
			var url="addToChair"
			url=url+"/"+chairid+"/"+contentid
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
			xmlHttp.open("GET",url,false)
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
			var url="delete/"
			url=url+contentid
			//url=url+"&sid="+Math.random()	
			//xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,false)
			xmlHttp.send(null) 
			//window.location.href=url;
  		}
	</script>
	
@stop