<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
     protected $table='payee';
    protected $fillable=[
        'name',
        'tin',
        'mobile',
        'email',
        'status'
    ];
}
