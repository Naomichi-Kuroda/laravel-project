<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    protected $table = 'towers';

    protected $fillable = [
        'name'
    ];

    public function residence()
    {
        return $this->belongsTo('App\Residence');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
