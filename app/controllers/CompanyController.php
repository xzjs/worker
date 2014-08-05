<?php

class CompanyController extends HomeController{

	public function tolist(){
		$company=Company::all();
		return View::make('companyList')->with('companies',$company);
	}

	public function delete($id)
	{
		//Session::put('id',$id);
		$company=Company::find($id);
		$company->delete();
		return Redirect::to('companyList');
	}

	public function add()
	{
		$name=Input::get('company_name');
		$company=new Company;
		$company->CompanyName=$name;
		$company->save();
		return Redirect::to('companyList');
	}
}

?>