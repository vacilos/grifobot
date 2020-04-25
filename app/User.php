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
            return "Νηπιαγωγείο";
        }
        if($this->level == 8) {
            return "Α' Γυμνασίού";
        }
        if($this->level == 9) {
            return "Β' Γυμνασίού";
        }
        if($this->level == 10) {
            return "Γ' Γυμνασίού";
        }
        if($this->level == 11) {
            return "Α' Λυκείου";
        }
        if($this->level == 12) {
            return "Β' Λυκείου";
        }
        if($this->level == 13) {
            return "Γ' Λυκείου";
        }

    }

    public function municipality() {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }


    public function hasRole($role) {

        $roles = explode("|", $role);
        foreach($roles as $r) {
            if($this->role == $r) {
                return true;
            }
        }

        return false;

    }

    /**
     * The roles that belong to the user.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'users_badges');
    }

    public function clasrooms() {
        return $this->hasMany(Classroom::class);
    }

}
