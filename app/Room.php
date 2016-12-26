<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name'
    ];

    public function tower()
    {
        return $this->belongsTo('App\Tower');
    }

    public function residents()
    {
        return $this->hasMany('App\Resident');
    }
}
