<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function showSMG() {
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

    public function municipality() {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }


    public function hasRole($role) {

        if($this->role != $role) {
            return false;
        }

        return true;

    }
}
