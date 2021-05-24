<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetails extends Model
{
    use HasFactory;

    protected $primaryKey = "user_bank_id";

    protected $fillable = [
        'user_id',
        'bank_account_number',
        'ifsc',
        'account_name',
    ];

    protected $hidden = [
        'user_bank_id',
        'created_at',
        'updated_at'
    ];
}
