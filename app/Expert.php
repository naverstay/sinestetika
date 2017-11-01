<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    //

    use \SleepingOwl\Admin\Traits\OrderableModel, \Laravel\Scout\Searchable;

    public $timestamps = false;

    public function specs()
    {
        return $this->belongsToMany(\App\Spec::class);
    }

    public function industries()
    {
        return $this->belongsToMany(\App\Industry::class);
    }

    public function orders() {
        return $this->hasMany(\App\Order::class);
    }

    public function getTotalOrdersAttribute()
    {
        return $this->hasMany(\App\Order::class)->count();
    }

    public function getTotalPaidOrdersAttribute()
    {
        return $this->hasMany(\App\Order::class)->whereNotNull('paid_date')->count();
    }

    public function scopeVisible($query) {
        return $query->where('visible', 1);
    }

    public function scopeMainList($query, $limit=0, $offset=0) {
        $query
            ->select('id', 'first_name', 'last_name', 'photo', 'status_text', 'small_descr')
            ->where('visible', 1)
            ->where('is_founder', 0)
        ;

        if($limit || $offset) {
            $this->scopeLimit($query, $limit, $offset);
        }

        return $query;
    }

    public function scopeLimit($query, $limit, $offset) {
        $limit = (int)$limit;
        $offset = (int)$offset;

        if($offset && $offset > 0) {
            $query->skip($offset);
        }

        if($limit && $limit > 0) {
            $query->take($limit);
        }

        return $query;
    }

    public function scopeFounder($query) {
        return $query
            ->with(['specs', 'industries'])
            ->select('id', 'first_name', 'last_name', 'photo', 'status_text', 'small_descr')
            ->where('visible', 1)
            ->where('is_founder', 1)
        ;
    }

    public function scopeBySpec($query, $spec_id) {
        return $query->whereHas('specs', function ($query) use($spec_id) {
            return $query->where('id', (int)$spec_id);
        });
    }

    public function scopeByIndustry($query, $industry_id) {
        return $query->whereHas('industries', function ($query) use($industry_id) {
            return $query->where('id', (int)$industry_id);
        });
    }

    // text search by Laravel Scout
    public function toSearchableArray() {
        return [
            'id'            => $this->getKey(),
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'status_text'   => $this->status_text,
            'small_descr'   => $this->small_descr,
            'description'   => $this->description,
            'order'         => $this->order
        ];
    }

    public function scopeRelated($query, $byId) {
        return $query
            ->where('id', '!=', $byId)
            ->orderByRaw("RAND()")
        ;
    }
}
