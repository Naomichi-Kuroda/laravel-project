<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name', 'leave_apply_span', 'contract_span', 'manage_code', 'memo'
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
