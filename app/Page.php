<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    public function town() {
        return $this->belongsTo(Town::class, 'town_id');
    }
}
