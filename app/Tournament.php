<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Plan;

class Tournament extends Model
{

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function plans() {
        return $this->belongsToMany(Plan::class, 'tournament_plans')->withPivot('order')->withTimestamps();
    }

    public function scores() {
        return $this->belongsToMany(TournamentScore::class, 'tournament_scores')->withPivot('started')->withPivot('score')->withPivot('movements')->withPivot('game')->withTimestamps();
    }
}
