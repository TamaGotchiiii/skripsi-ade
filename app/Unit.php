<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function complains()
    {
        return $this->hasMany(Complain::class);
    }
}
