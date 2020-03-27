<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //
    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_badges');
    }
}
