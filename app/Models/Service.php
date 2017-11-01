<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Section;

class Service extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['caption', 'name', 'main_caption', 'land_caption','main_descr', 'short_descr', 'descr', 'order'];

    public function sections() {
        return $this->hasMany(ServiceSection::class);
    }

    public function tags() {
        return $this->morphMany(Tag::class, 'owner', 'persons_tasks')->withPivot('type')->where('type', 0);
    }

    public function scopeHome($query) {
        return $query
            ->select('id', 'name', 'main_caption', 'main_descr', 'short_descr')
            ->orderBy('order')
        ;
    }
}