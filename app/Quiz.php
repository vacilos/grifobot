<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    public function maths() {
        return $this->belongsToMany(Math::class, 'quiz_math')->withTimestamps();
    }
}
