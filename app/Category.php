<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function maths() {
        return $this->hasMany(Math::class);
    }
}
