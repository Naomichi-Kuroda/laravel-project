<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    protected $table = 'residences';

    protected $fillable = [
        'name', 'zip_code', 'prefecture', 'city', 'town'
    ];

    public function towers()
    {
        return $this->hasMany('App\Tower');
    }
}
