<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'bank_name',
        'slug',
        'bank_code'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'bank_name',
                'onUpdate' => true,
            ]
        ];
    }

    public function branches(): HasMany
    {
        return $this->hasMany(BankBranch::class, 'bank_id', 'id');
    }
}
