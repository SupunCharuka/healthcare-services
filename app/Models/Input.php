<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'service_category_id',
        'name',
        'type',
        'placeholder',
        'option',
        'slug',
        'order',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class,'service_category_id','id');
    }

}
