<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['tag_id', 'service_id', 'caption', 'descr', 'order', 'visible'];

    public function tags() {
        return $this->belongsToMany(Tag::class)->withPivot('id', 'service_section_id', 'tag_id', 'order')->orderBy('pivot_order', 'ASC');
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}