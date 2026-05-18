<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelStation extends Model
{
    protected $table='fuel_station';
    protected $fillable=[
        'name',
        'tin',
        'address'
    ];
}
