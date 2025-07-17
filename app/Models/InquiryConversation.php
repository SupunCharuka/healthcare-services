<?php

namespace App\Models;

use App\Services\FirebaseCloudMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Log;

class InquiryConversation extends Model
{

    protected $fillable = [
        'inquiry_id',
        'sender_id',
        'receiver_id',
        'reply_id',
        'text',
        'name',
        'mime_type',
        'attachment_name',
        'width',
        'height',
        'size',
        'status',
        'type',
    ];

    protected static function booted()
    {
        static::created(function (self $conversation) {
            try {
                $fcmClient = new FirebaseCloudMessage;
                $fcmClient->sendPushNotification(
                    title: $conversation->sender->name,
                    body: $conversation->text ?? "Sent an📎Attachment.",
                    routeName: "inquiries/conversations/{$conversation->inquiry_id}",
                    deviceToken: $conversation->receiver->fcm_token,
                );
            } catch (\Exception $e) {
                Log::error(
                    'InquiryConversation SEND PUSH NOTIFICATION: ' . '[' . $e->getMessage() . '] '
                );
            }
        });
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class, 'inquiry_id')->withDefault();
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id')->withDefault();
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id')->withDefault();
    }

    public function repliedMessage(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reply_id');
    }

}
