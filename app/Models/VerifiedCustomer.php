<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifiedCustomer extends Model
{
    use HasFactory;

    // Jedwali linalotumika
    protected $table = 'verified_customer';

    // Sehemu zinazoweza kujazwa (mass assignable)
    protected $fillable = [
        'name',
        'phone_number',
        'customer_type',
        'business_activity_id',
        'customer_id',
        'control_number',
        'status',
    ];

    /**
     * Uhusiano na model ya BusinessActivity
     * (kama business_activity ni model nyingine)
     */
    public function businessActivity()
    {
        return $this->belongsTo(BusinessActivity::class);
    }

    /**
     * Optionally: Accessor kwa status
     * Kubadilisha '0'/'1' kuwa maneno
     */
    public function getStatusLabelAttribute()
    {
        return $this->status === '1' ? 'Active' : 'Inactive';
    }


     public function bills()
    {
        return $this->hasMany(Bill::class, 'customer_id');
    }

    public function payments()
{
    return $this->hasMany(TcbTransaction::class, 'reference', 'control_number');
}
    
}
