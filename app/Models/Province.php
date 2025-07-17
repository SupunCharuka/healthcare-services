<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }


    public function districts()
    {
        return $this->hasMany(District::class, 'province_id');
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, District::class, 'province_id', 'district_id');
    }

}
