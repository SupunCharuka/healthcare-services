<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputDetaile extends Model
{
    use HasFactory;

    protected $fillable = ['inquiry_id','input_id', 'data'];


    public function input()
    {
        return $this->belongsTo(Input::class,'input_id','id');
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class,'inquiry_id','id');
    }
}
