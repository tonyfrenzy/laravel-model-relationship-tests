<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id', 'details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
