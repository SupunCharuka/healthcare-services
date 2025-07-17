<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
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

    public function productSubCategories(): HasMany
    {
        return $this->hasMany(ProductSubCategory::class, 'product_category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }


}
