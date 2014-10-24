@extends('master')

@section('content')
	{{Form::open(array('url'=>'changePassword'))}}
		<p>
			原 密 码
			<input type="password" id="password1"  required="required">
		</p>
    	<p>
    		重复密码
    		<input type="password" id="password2" name="p2" required="required">
    	</p>
    	<p>
    		新 密 码
    		<input type="password" id="new" name="new" required="required">
    	</p>
		<p>
			<input type=submit onclick=checkPasswords() value='修改'>
		</p>
		<p>
			<?php
				if($error!=null){
					echo $error;
				}
			?>
		</p>
		<script type="text/javascript">
		function checkPasswords() {
        	var pass1 = document.getElementById("password1");
        	var pass2 = document.getElementById("password2");

        	if (pass1.value != pass2.value)
            	pass2.setCustomValidity("两次输入的密码不匹配");
        	else
            	pass2.setCustomValidity("");
            	//document.forms[0].submit(); 
    	}
    	</script>

	{{Form::close()}}
@stop