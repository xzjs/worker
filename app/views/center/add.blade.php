@extends('master')

@section('content')
	{{Form::open(array('url'=>asset('center/list')))}}
		<input type="text" name="center_name" required="required" placeholder="请输入培训中心名称">
		<br>
		<?php
			$companies=Company::all();
			echo '<select name="company_id">';
			foreach ($companies as $company) {
				echo "<option value='".$company->id."'>".$company->CompanyName."</option>";
			}
			echo "</select>";
		?>
		<br>
		{{Form::submit('确定')}}
	{{Form::close()}}
@stop