<?php

class ProjectHelper extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_helpers';

    public function projects()
    {
        return $this->hasMany('Project');
    }

    public function users()
    {
        return $this->hasMany('User');
    }

}
