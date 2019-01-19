<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = [
        'name',
        'id_number',
        'email',
        'description',
        'complain_type_id',
        'user_id',
        'unit_id',
        'status',
    ];

    public function complain_type()
    {
        return $this->belongsTo(ComplainType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
