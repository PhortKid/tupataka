<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    /**
     * Jina la jedwali lililopo kwenye database.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * Nguzo zinazoruhusiwa kuingizwa data kwa wingi (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname_business_name',
        'firstname',
        'middlename',
        'lastname',
        'phone_number',
        'reg_no',
        'registered_by',
        'gps_coordinates',
        'ward_id',
        'district_id',
        'region_id',
        'street_id',
        'house_no',
        'house_owner_mobile',
        'idadi_kaya',
        'business_activity_id',
        'is_confirmed',
        'customer_type',
        'irregular_amount',
        'status',
    ];

    /**
     * Ubadilishaji wa aina za data (Data Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_confirmed' => 'boolean',
        'idadi_kaya' => 'integer',
        'irregular_amount' => 'decimal:2',
        'status' => 'integer',
    ];

    /**
     * Uhusiano: Customer anamilikiwa na Mtumiaji (User) aliyemsajili.
     */
    public function registered_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Uhusiano: Customer yupo kwenye Mtaa (Street) fulani.
     */
    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class, 'street_id');
    }

    /**
     * Uhusiano: Customer yupo kwenye Kata (Ward) fulani.
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    /**
     * Uhusiano: Customer yupo kwenye Wilaya (District) fulani.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Uhusiano: Customer yupo kwenye Mkoa (Region) fulani.
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Uhusiano: Customer ana aina fulani ya biashara (Business Activity).
     */
    public function businessActivity(): BelongsTo
    {
        return $this->belongsTo(BusinessActivity::class, 'business_activity_id');
    }
}
