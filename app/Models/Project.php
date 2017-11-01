<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['caption', 'name', 'short_descr', 'descr', 'photo', 'order', 'visible'];

    public function tags() {
        return $this->belongsToMany(Tag::class)->withPivot('id', 'project_id', 'tag_id', 'order')->orderBy('pivot_order', 'ASC');
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function sections() {
        return $this->hasMany(ProjectSection::class);
    }

    public function getPhotoMAttribute() {
        $info = pathinfo( public_path($this->photo) );

        $path = $info['dirname'] . '/' . $info['filename'] . '_m.' . $info['extension'];
        $path = str_replace(public_path(), '', $path);

        return (is_file( public_path($path) ) ? $path : $this->photo);
    }

    public function getPhotoRetinaAttribute() {
        $info = pathinfo( public_path($this->photo) );

        $path = $info['dirname'] . '/' . $info['filename'] . '_2x.' . $info['extension'];
        $path = str_replace(public_path(), '', $path);

        return (is_file( public_path($path) ) ? $path : $this->photo);
    }

    public function scopeHome($query) {
        $query
            ->with([
                'tags' => function($query) {
                    return $query
                        ->select('tags.id', 'tags.caption')
                    ;
                }
            ])
            ->select('projects.id', 'projects.caption', 'projects.name', 'projects.photo', 'projects.short_descr')
            ->where('projects.visible', 1)
            ->orderBy('projects.order')
        ;
        return $query;
    }

    public function scopeSingle($query, $name_or_id) {
        if((string)(int)$name_or_id == $name_or_id) {
            $query->where('projects.id', $name_or_id);
        } else {
            $query->where('projects.name', $name_or_id);
        }

        $query
            ->where('projects.visible', 1)
            ->with([
                'tags',
                'sections' => function($query) {
                    return $query
                        ->where('visible', 1)
                        ->orderBy('order')
                        ;
                }
            ])
        ;

        return $query;
    }
}