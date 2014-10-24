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

Route::pattern('id', '[0-9]+');

Route::get('/', function()
{
	return View::make('login')->with('error',null);
});
Route::post('login','UserController@login');

Route::group(array('before' => 'auth'), function()
{
    Route::get('index','WorkerController@index');

	Route::post('index','WorkerController@getSunday');

	Route::get('changePassword',function(){
		return View::make('changePassword')->with('error',null);
	});
	Route::post('changePassword','UserController@changePassword');

	Route::get('logout',function(){
		Auth::logout();
		return Redirect::to('/');
	});

	Route::get('{view}/{action}/{id1?}/{id2?}','WorkerController@workerget');
	Route::post('{view}/{action}','WorkerController@workerpost');
});




