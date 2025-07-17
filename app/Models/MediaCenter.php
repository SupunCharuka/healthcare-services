<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCenter extends Model
{
    use HasFactory;

    protected $fillable = ['file_name'];
}
