<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

    public function projects()
    {
        return $this->belongsToMany('Project', 'project_tag');
    }

}
