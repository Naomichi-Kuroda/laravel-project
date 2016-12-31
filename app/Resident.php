<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $fillable = [
        'name', 'phone_number', 'start_date', 'end_date', 'limit_date', 'memo',
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
