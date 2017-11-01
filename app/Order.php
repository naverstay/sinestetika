<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['expert_id', 'fio', 'email', 'phone', 'comment', 'paid_status', 'paid_date'];

    public function expert() {
        return $this->belongsTo('\App\Expert');
    }
}
