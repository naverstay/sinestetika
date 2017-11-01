<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    //

    public $timestamps = false;

    public function specs()
    {
        return $this->belongsToMany(\App\Expert::class);
    }
}
