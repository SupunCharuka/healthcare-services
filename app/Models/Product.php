<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'product_category_id',
        'product_subcategory_id',
        'slug',
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

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function productSubcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_subcategory_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class,'product_id','id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'product_id','id');
    }

}
