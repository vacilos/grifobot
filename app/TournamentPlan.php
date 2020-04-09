<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentPlan extends Model
{
    //

    public function tournament() {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
