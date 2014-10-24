<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function roles()
	{
		return $this->belongsToMany('Role');
	}

	public function center()
	{
		return $this->belongsTo('Center');
	}

	public function contents()
	{
		return $this->hasMany('Content');
	}

	public function shares()
	{
		return $this->hasMany('Share');
	}

	public function songs()
	{
		return $this->hasMany('Song');
	}
}
