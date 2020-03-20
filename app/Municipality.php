<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //
    public function __toString() {
        return $this->municipality;
    }

    public function users() {
        return $this->hasMany(User::class);
    }

}
