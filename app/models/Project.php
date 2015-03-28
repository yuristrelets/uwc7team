<?php

class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

    public function helpers()
    {
        return $this->hasMany('ProjectHelper');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag', 'project_tag');
    }

    public function news()
    {
        return $this->hasMany('News');
    }

    public function helpTypes()
    {
        return $this->belongsToMany('HelpType', 'project_help_type');
    }

}
