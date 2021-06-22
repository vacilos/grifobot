<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tournament;

class Plan extends Model
{
    //
    public function scores() {
        return $this->hasMany(Score::class);
    }

    public function town() {
        return $this->belongsTo(Town::class);
    }
}
