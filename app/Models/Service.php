<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use Loggable;

    protected $fillable = [
        'title',
        'service_category_id',
        'sub_categories_id',
        'slug',
        'image',
        'number',
        'district_id',
        'city_id',
        'description',
        'user_id',
        'status'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_categories_id', 'id');
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
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function weeklyAvailabilities()
    {
        return $this->hasMany(WeeklyAvailability::class, 'service_id', 'id');
    }

    public function bankDetail()
    {
        return $this->hasOne(BankDetail::class, 'service_id', 'id')->withDefault();
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class, 'service_id', 'id');
    }

    public function commissionPayouts()
    {
        return $this->hasMany(CommissionPayout::class, 'service_id', 'id');
    }
}
