<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    public function scores() {
        return $this->hasMany(Score::class);
    }
}
