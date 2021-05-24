<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDetails extends Model
{
    use HasFactory;

    protected  $primaryKey = "loan_id";

    protected $fillable = [
        'user_id',
        'loan_amount',
        'loan_application_id',
        'loan_tenure',
        'interest',
        'user_bank_id'
    ];

    protected $hidden = [
        'loan_id',
        'updated_at'
    ];

    public function summary()
    {
        return $this->hasOne(LoanSummary::class, 'loan_id');
    }

    public function bank()
    {
        return $this->hasOne(UserBankDetails::class, 'user_bank_id', 'user_bank_id');
    }

    public function history()
    {
        return $this->hasMany(LoanPaymentHistory::class, 'loan_id')->orderBy('loan_payment_histories_id', 'desc')->limit(10);
    }

}
