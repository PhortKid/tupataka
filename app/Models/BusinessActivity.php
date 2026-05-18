<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessActivity extends Model
{
    use HasFactory;

    protected $table = 'business_activity';

    protected $fillable = [
        'name',
        'payment_type',
        'bill_amount',
        'description',
    ];
}
