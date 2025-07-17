<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Loggable;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'number',
        'amount',
        'district_id',
        'city_id',
        'status',
        'payment_method',
        'bank_receipt',
        'bank_receipt_description',
        'payment_response',
        'received_at',
    ];


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
