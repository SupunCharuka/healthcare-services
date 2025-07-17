<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image',
        'link_to',
        'is_active',
        'local_order',
        'foreign_order',
        'mobile_image',
    ];

    protected $casts = ['is_active' => 'bool'];

}
