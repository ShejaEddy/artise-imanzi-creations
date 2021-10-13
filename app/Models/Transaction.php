<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'names',
        'email',
        'phone',
        'order_id',
        'amount',
        'currency',
        'transaction_id',
        'flw_ref',
        'tx_ref',
        'status'
    ];
}
