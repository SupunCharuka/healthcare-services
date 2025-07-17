<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStaticInputData extends Model
{
    protected $fillable = [
        'service_category_id',
        'service_static_inputs_id',
        'availability',
    ];


    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function serviceStaticInput(): BelongsTo
    {
        return $this->belongsTo(ServiceStaticInput::class, 'service_static_inputs_id', 'id');
    }
}
