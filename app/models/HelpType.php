<?php

class HelpType extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'help_types';

    public function projects()
    {
        return $this->belongsToMany('Project', 'project_help_type');
    }

}
