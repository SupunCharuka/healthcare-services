<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'local_order',
        'foreign_order',
        'commission',
        'video_id', // video_id_eng also can be used
        'video_id_si',
        'description',
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

    public function getVideoIdAttribute(string|null $value)
    {
        // TODO: validate video id is valid youtube id here
        if (!empty($value)) {
            return $value;
        }
        return null;
    }

    public function getVideoIdEngAttribute()
    {
        return $this->video_id;
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'service_category_id', 'id');
    }

    public function staticInputs(): HasMany
    {
        return $this->hasMany(ServiceStaticInputData::class, 'service_category_id', 'id')->where('availability', 1);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'service_category_id', 'id');
    }

    public function inputs()
    {
        return $this->hasMany(Input::class, 'service_category_id', 'id');
    }
}
