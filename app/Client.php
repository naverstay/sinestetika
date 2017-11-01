<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;
}
