<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle';

    protected $fillable = [
        'plate_number',
        'type',
        'capacity',
        'availability_status',
        'status',
    ];
}