<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'loan_date',
        'return_date',
        'actual_return',
        'status',
        'fine_amount'
    ];

    public function items()
    {
        return $this->hasMany(LoanItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // total buku dipinjam (akumulasi quantity)
    public function totalBooks(): int
    {
        return (int) $this->items()->sum('quantity');
    }
}
