<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use Loggable;

    protected $fillable = [
        'user_id',
        'address',
        'district_id',
        'city_id',
        'postcode',
        'owner_name',
        'registration_no',
        'document',
        'status',
    ];

    protected $casts = ['status' => 'bool'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class)->withDefault(new City);
    }

    public function district()
    {
        return $this->belongsTo(District::class)->withDefault(new City);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault(new City);
    }
}
