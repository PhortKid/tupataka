<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeoStaff extends Model
{
    use HasFactory;

    protected $table = 'weo_staff';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'phone_number',
        'email',
    ];
}
