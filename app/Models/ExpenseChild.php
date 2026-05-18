<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseChild extends Model
{
    use HasFactory;

    protected $table = 'expense_children';

    protected $fillable = [
        'expense_id',
        'expense_name_id',
        'amount',
        'description',
    ];

    public function parent()
    {
        return $this->belongsTo(ExpenseParent::class, 'expense_id');
    }

        public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_name_id');
    }
}
