<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'ward';

    protected $fillable = [
        'name',
        'description',
        'status',
        'district_id',
        'region_id',
        'weo_staff_id', 
    ];

    public function weoStaff()
    {
        return $this->belongsTo(WeoStaff::class, 'weo_staff_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
