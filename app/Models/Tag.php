<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user_pages()
    {
        return $this->belongsToMany(UserPage::class)->withPivot('status');;
    }

    protected $fillable = [
        'name',
        'start_date',
        'final_date'
    ];
}
