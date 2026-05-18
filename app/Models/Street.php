<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $table = 'street';

    protected $fillable = [
        'name',
        'description',
        'status',
        'ward_id',
        'district_id',
        'region_id',
    ];

    // Relationship to Ward
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    // Relationship to District
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Relationship to Region
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}