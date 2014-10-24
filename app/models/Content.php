<?php

class Content extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contents';

	public function chairs()
    {
        return $this->hasMany('Chair');
    }
	
}
