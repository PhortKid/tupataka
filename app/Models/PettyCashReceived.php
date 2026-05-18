<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PettyCashReceived extends Model
{
    use HasFactory;

    protected $table = 'petty_cash_received';

    protected $fillable = [
        'date_received',
        'cash_source_id',
        'amount',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationship with PettyCashSource
     */
    public function source()
    {
        return $this->belongsTo(PettyCashSource::class, 'cash_source_id');
    }

    /**
     * Relationship with User (created_by)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship with User (updated_by)
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
