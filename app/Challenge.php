<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    //
    public function fromUser() {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    //
    public function toUser() {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

}
