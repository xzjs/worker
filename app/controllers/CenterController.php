<?php

class CenterController extends HomeController{

	public function tolist(){
		$centers=Center::all();
		return View::make('centerList')->with('centers',$centers);
	}

	public function delete($id)
	{
		$center=Center::find($id);
		$center->delete();
		return Redirect::to('centerList');
	}

	public function add()
	{
		$name=Input::get('center_name');
		$company_id=Input::get('company_id');
		$center=new Center;
		$center->CompanyID=$company_id;
		$center->CenterName=$name;
		$center->save();
		return Redirect::to('centerList');
	}

	public function preAdd()
	{
		$companies=Company::all();
		return View::make('centerAdd')->with('companies',$companies);
	}
}

?>