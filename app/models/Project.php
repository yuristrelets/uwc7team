<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Project extends Eloquent {

    use SoftDeletingTrait;

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
    protected $softDelete = true;
    protected $guarded = array('id');

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

    public function subscribers()
    {
        return $this->belongsToMany('User', 'subscriber_project');
    }

    public function author()
    {
        return $this->belongsTo('User');
    }

}
