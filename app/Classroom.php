<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
