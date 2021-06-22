<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    //
    public function pages() {
        return $this->hasMany(Page::class);
    }

    public function plans() {
        return $this->hasMany(Plan::class);
    }
}
