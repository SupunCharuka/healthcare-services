<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDetail extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'user_id',
        'title',
        'start_date',
        'end_date',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
