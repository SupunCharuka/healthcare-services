<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceStaticInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function serviceStaticInputData()
    {
        return $this->hasMany(ServiceStaticInputData::class, 'service_static_inputs_id', 'id');
    }
}
