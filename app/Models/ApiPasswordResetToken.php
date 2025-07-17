<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiPasswordResetToken extends Model
{
    protected $fillable = [
        'user_id',
        'token_signature',
        'token_type',
        'used_token',
        'expires_at',
    ];

    public const PASSWORD_VERIFY_TOKEN = 10;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
