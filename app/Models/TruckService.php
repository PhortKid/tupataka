<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_date',
        'truck_id',
        'service_category_id',
        'next_service_reading',
        'service_cost',
        'remarks',
        'served_by',
        'created_by',
        'updated_by',
        'status',
    ];

    // Relations
    public function truck()
    {
        return $this->belongsTo(Vehicle::class, 'truck_id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(VehicleServiceCategory::class, 'service_category_id');
    }

    public function server()
    {
        return $this->belongsTo(User::class, 'served_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
