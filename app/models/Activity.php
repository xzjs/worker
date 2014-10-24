<?php

class Activity extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity';

	public function chair()
    {
        return $this->hasOne('Chair');
    }
}