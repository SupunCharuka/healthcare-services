<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'account_holder',
        'account_number',
        'bank_id',
        'branch_id',
        'bank_book',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }  

    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id','id');
    }

    public function branch()
    {
        return $this->belongsTo(BankBranch::class,'branch_id','id');
    }
}
