<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelRate extends Model
{
    protected $table='fuel_rate';

    protected $fillable=[
        'type',
        'rate'
    ];
}
