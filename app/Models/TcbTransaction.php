<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcbTransaction extends Model
{
    use HasFactory;

    protected $table = 'tcb_transactions';

    protected $fillable = [
        'raw_payload',
        'transaction_id',
        'reference',
        'amount',
        'currency',
        'transaction_date',
        'phone',
        'description',
        'account_no',
        'charge',
        'balance',
        'status',
        'status_desc',
    ];

    // Optional: Accessor to decode raw payload
    public function getPayloadAttribute()
    {
        return json_decode($this->raw_payload, true);
    }
    
    public function customer()
{
    return $this->belongsTo(VerifiedCustomer::class, 'reference', 'control_number');
}
}
