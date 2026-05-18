<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel convention)
    protected $table = 'bills';

    // Fields we can mass assign
    protected $fillable = [
        'customer_id',
        'amount',
        'date',
    ];

    /**
     * Relationship: Bill belongs to a VerifiedCustomer
     */
    public function customer()
    {
        return $this->belongsTo(VerifiedCustomer::class, 'customer_id');
    }
}
