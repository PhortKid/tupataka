<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseParent extends Model
{
    use HasFactory;

    protected $table = 'expense_parents';

    protected $fillable = [
        'expense_date',
        'payee_id',
        'voucher_no',
        'approved_status',
        'required_imprest',
        'approved_by',
        'approved_date',
        'cashout_by',
        'cashout_on',
        'created_by',
        'deleted_by',
        'deleted_on',
        'active'
    ];

    public function children()
    {
        return $this->hasMany(ExpenseChild::class, 'expense_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashout_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payee()
{
    return $this->belongsTo(User::class, 'payee_id');
}
}
