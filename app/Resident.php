<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $fillable = [
        'name'
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
