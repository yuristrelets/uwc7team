<?php

class HelpType extends Eloquent {

    public $timestamps = false;

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
