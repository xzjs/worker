<?php

class Chair extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'chair';

	public function activity()
    {
        return $this->belongsTo('Activity');
    }

    public function content(){
    	return $this->belongsTo('Content');
    }

    public function share(){
    	return $this->belongsTo('Share');
    }

    public function song(){
    	return $this->belongsTo('Song');
    }
}
