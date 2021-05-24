<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPaymentHistory extends Model
{
    use HasFactory;

    protected $primaryKey = "loan_payment_histories_id";

    protected $fillable =[
        'loan_id',
        'user_id',
        'paid_amount',
        'transaction_id'
    ];

    protected $hidden = [
        'loan_payment_histories_id',
        'updated_at'
    ];
}
