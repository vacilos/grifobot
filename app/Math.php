<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Math extends Model
{
    //

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function showLevel() {
        if($this->level == 1) {
            return "Α' Δημοτικού";
        }

        if($this->level == 2) {
            return "Β' Δημοτικού";
        }

        if($this->level == 3) {
            return "Γ' Δημοτικού";
        }

        if($this->level == 4) {
            return "Δ' Δημοτικού";
        }

        if($this->level == 5) {
            return "Ε' Δημοτικού";
        }

        if($this->level == 6) {
            return "ΣΤ' Δημοτικού";
        }

        if($this->level == 7) {
            return "Α' Γυμνασίού";
        }

        if($this->level == 8) {
            return "Β' Γυμνασίου";
        }

        if($this->level == 9) {
            return "Γ' Γυμνασίου";
        }
    }

}
