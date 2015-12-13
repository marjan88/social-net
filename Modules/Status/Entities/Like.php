<?php

namespace Modules\Status\Entities;

use Illuminate\Database\Eloquent\Model;

class Like extends Model  {

    protected $table = 'likeable';

    public function likeable() {
        return $this->morphTo();
    }
    
    public function user() {
        return $this->belongsTo('Modules\User\Entities\User', 'user_id');
    }

   
}
