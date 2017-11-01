<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHomeTag extends Model
{
    use \SleepingOwl\Admin\Traits\OrderableModel;

    public $timestamps = false;

    public $fillable = ['service_id', 'section_id', 'caption', 'order', 'visible'];

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function section() {
        return $this->belongsTo(ServiceSection::class, 'section_id');
    }
}