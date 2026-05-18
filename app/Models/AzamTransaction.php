<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzamTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',     // reference from AzamPay
        'status',             // success / failure
        'amount',             // charged amount
        'payer',              // msisdn (phone number)
        'provider',           // Airtel, Tigo, Mpesa, etc.
        'message',            // description from AzamPay
        'utilityref',         // your order ID
        'fsp_reference_id',   // partner reference
        'raw_payload',        // full JSON callback
    ];
}
