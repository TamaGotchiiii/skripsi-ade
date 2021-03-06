<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'title',
        'name',
        'complain_id',
    ];

    public function complain()
    {
        return $this->belongsTo(Complain::class);
    }
}
