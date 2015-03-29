<?php

class News extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'news';
    protected $softDelete = true;

    public function project()
    {
        return $this->belongsTo('Project');
    }
}
