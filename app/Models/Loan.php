<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nominal',
        'length_of_loan',
        'interest_rate',
        'status',
    ];

    public function installments()
    {
        return $this->hasMany(Installment::class, 'loan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
