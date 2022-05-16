<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserPage extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('status');;
    }
    protected $fillable = [
        'name',
        'main_page',
        'main_id',
        'second_page',
        'second_id',
        'third_page',
        'third_id',
        'phone',
        'admin_id',
        'super_admin_id',
        'expire',
        'expired_at',
        'warning',
        'exclusion',
        'exclusion',
    ];
}
