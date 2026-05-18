<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PettyCashSource extends Model
{
     protected $table='petty_cash_source';
    protected $fillable=[
        'name',
        'description',
        'status'
      
    ];
}
