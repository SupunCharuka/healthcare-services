<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class MemberRegister extends Model
{
    use Loggable;

    protected $fillable = [
        'id',
        'user_id',
        'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'service_category_id', 'id');
    }
}
