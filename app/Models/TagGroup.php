<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagGroup extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['caption', 'name', 'order'];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}