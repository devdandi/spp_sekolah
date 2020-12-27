<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'parent_id',
        'tunggakan_id',
        'snap_token',
        'subtotal',
        'status',
        'payment_type',
        'transaction_details',
    ];
}
