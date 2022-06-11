<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    
    protected $fillable = [
        'user_id',
        'amount',
        'transaction_id',
        'reference_id',
        'verified_at',
        'failed_at',
        'paid_at',
    ];
}