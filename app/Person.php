<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    public function plans() {
        return $this->hasMany( Plans::class);
    }
}
