<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleServiceCategory extends Model
{
    protected $table = 'vehicle_service_category';

    protected $fillable = [
        'service_name',
        'description',
        'status',
    ];
}