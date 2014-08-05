<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login');
});

Route::get('train','ArrangeController@train');

//Center
Route::get('centerList','CenterController@tolist');
Route::get('center/delete/{id}', 'CenterController@delete')->where('id', '[0-9]+');
Route::get('centerAdd','CenterController@preAdd');
Route::post('centerList','CenterController@add');

//Company
Route::get('companyList','CompanyController@tolist');
Route::get('company/delete/{id}', 'CompanyController@delete')->where('id', '[0-9]+');
Route::get('companyAdd',function(){
	return View::make('companyAdd');
});
Route::post('companyList','CompanyController@add');