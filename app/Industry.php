<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    //

    public $timestamps = false;

    public function industries()
    {
        return $this->belongsToMany(\App\Expert::class);
    }
}
