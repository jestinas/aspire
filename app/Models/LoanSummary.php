<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSummary extends Model
{
    use HasFactory;

    protected $primaryKey = "loan_summaries_id";

    protected $fillable = [
        'loan_id',
        'loan_amount',
        'total_paid',
        'interest_charged',
        'balance_term',
        'last_payment_date',
        'next_payment_date',
    ];

    protected $hidden = [
        'loan_summaries_id',
        'loan_id',
        'updated_at',
        'created_at'
    ];

    public function loan()
    {
        return $this->belongsTo(LoanDetails::class, 'loan_id');
    }
}
