<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \SleepingOwl\Admin\Traits\OrderableModel;

class ProjectTag extends Model
{
    use OrderableModel;

    public $timestamps = false;

    protected $table = 'project_tag';

    public $fillable = ['project_id', 'tag_id', 'order'];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}