<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'admin_id',
        'super_admin_id',
    ];
}
