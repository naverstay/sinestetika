<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \SleepingOwl\Admin\Traits\OrderableModel;

class ServiceSectionTag extends Model
{
    use OrderableModel;

    public $timestamps = false;

    protected $table = 'service_section_tag';

    public $fillable = ['service_section_id', 'tag_id', 'order'];

    public function section() {
        return $this->belongsTo(ServiceSection::class, 'service_section_id');
    }

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}