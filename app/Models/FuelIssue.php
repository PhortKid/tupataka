<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelIssue extends Model
{
    use HasFactory;

    protected $table = 'fuel_issues';

    protected $fillable = [
        'issue_date',
        'fuel_type',
        'truck_id',
        'quantity',
        'amount',
        'staff_id_request',
        'created_by',
        'deleted_by',
        'approved_by',
        'approved_date',
        'status'
    ];

    /**
     * Mahusiano (Relationships)
     */
    
    // FuelIssue inahusiana na Truck (Vehicle)
    public function truck()
    {
        return $this->belongsTo(Vehicle::class, 'truck_id');
    }

    // Aliyeunda rekodi
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Aliyefuta rekodi
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    // Aliyeidhinisha
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
