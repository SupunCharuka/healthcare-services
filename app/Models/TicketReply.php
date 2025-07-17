<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'admin_id',
        'reply',
        'attachment',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault(fn () => new User);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id')->withDefault(fn () => new User);
    }
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
