<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
    public function user() {
        return $this->belongsTo(Person::class, 'person_id');
    }
}
