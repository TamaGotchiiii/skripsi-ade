<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplainType extends Model
{
    protected $fillable = [
        'title',
    ];

    public function complains()
    {
        return $this->hasMany(Complain::class);
    }
}
