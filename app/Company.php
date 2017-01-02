<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 'zip_code', 'prefecture', 'city', 'town', 'phone_number', 'memo'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
