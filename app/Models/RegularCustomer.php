<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegularCustomer extends Model
{
    use HasFactory;

    protected $table = 'regular_customer';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'phone_number',
        'gps_coordinates',
        'ward_id',
        'district_id',
        'region_id',
        'street_id',
        'house_no',
        'house_owner_mobile',
        'business_activity_id',
        'reg_no',
        'user_id',
        'idadi_kaya'
    ];

    // Relationships
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

      public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function business_activity()
    {
        return $this->belongsTo(BusinessActivity::class,'business_activity_id');
    }
}
