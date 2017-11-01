<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['caption','name','on_main','order'];

    public function serviceSections() {
        return $this->belongsToMany(ServiceSection::class);
    }

    public function services() {
        return $this->hasManyThrough(Service::class, ServiceSection::class, 'tag_id', 'service_id', 'id');
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }

    public function groups() {
        return $this->belongsToMany(TagGroup::class);
    }

    public function scopeByServices($query) {
        $query
            ->with([
                'serviceSections',
                'serviceSections.service' => function($query) {
                    return $query
                        ->select('id', 'name')
                    ;
                }
            ])
            ->orderBy('tags.order')
            ->where('on_main', 1)
            //->join('service_section_tag', 'service_section_tag.tag_id', '=', 'tags.id')
            //->join('service_sections', 'service_sections.id', '=', 'service_section_tag.service_section_id')
            ->whereHas('serviceSections', function($query) {
                $query
                    ->where('visible', 1)
                ;
            })
        ;
        return $query;
    }
}
