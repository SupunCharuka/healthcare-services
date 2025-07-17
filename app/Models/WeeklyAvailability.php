<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'week_day',
        'start_time',
        'end_time',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
