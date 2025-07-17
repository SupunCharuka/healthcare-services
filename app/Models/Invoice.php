<?php

namespace App\Models;

use App\Services\FirebaseCloudMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;

class Invoice extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'inquiry_id',
        'amount',
        'document',
        'payment_type',
        'comment',
        'paid',
        'document',
        'rejected_at',
        'payment_response',
    ];
    protected $casts = [
        'paid' => 'boolean',
        'rejected_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function (self $invoice) {
            try {
                $fcmClient = new FirebaseCloudMessage;
                if ($invoice->amount > 0 && !$invoice->paid) {
                    $fcmClient->sendPushNotification(
                        title: "New Invoice created!",
                        body: "Your inquiry for {$invoice->inquiry->serviceCategory->name} accepted & invoice created. Kindly confirm with payment.",
                        routeName: "customer/invoice/{$invoice->inquiry_id}",
                        deviceToken: $invoice->inquiry->user->fcm_token,
                    );
                    Log::info(
                        'NEWLY CREATED INVOICE SEND PUSH NOTIFICATION: Invoice Was Paid!'
                    );
                }
            } catch (\Exception $e) {
                Log::error(
                    'NEWLY CREATED INVOICE SEND PUSH NOTIFICATION: ' . '[' . $e->getMessage() . '] '
                );
            }
        });

        static::updated(function (self $invoice) {
//            if (true) {
            if ($invoice->isDirty('paid') || $invoice->isDirty('amount')) {
                try {
                    $fcmClient = new FirebaseCloudMessage;
                    if ($invoice->amount > 0 && !$invoice->paid) {
                        $amount = number_format($invoice->amount, 2);
                        $fcmClient->sendPushNotification(
                            title: "New Invoice created!",
                            body: "Your inquiry {$invoice->inquiry->serviceCategory->name} accepted & invoice created. Kindly confirm with payment.",
                            routeName: "customer/invoice/{$invoice->inquiry_id}",
                            deviceToken: $invoice->inquiry->user->fcm_token,
                        );
                        Log::info(
                            'INVOICE UPDATED SEND PUSH NOTIFICATION: New Invoice created!'
                        );
                    }

                    if ($invoice->paid) {
                        $amount = number_format($invoice->amount, 2);
                        $fcmClient->sendPushNotification(
                            title: "Invoice Was Paid!",
                            body: "Your Inquiry for {$invoice->inquiry->service->title} was confirmed, click to view the details",
                            routeName: "inquiries/view/{$invoice->inquiry_id}",
                            deviceToken: $invoice->inquiry->service->user->fcm_token,
                        );
                        $fcmClient->sendPushNotification(
                            title: "Your Payment Successful!",
                            body: "Your have successfully paid {$amount} to {$invoice->inquiry->serviceCategory->name}!",
                            routeName: "inquiries/view/{$invoice->inquiry_id}",
                            deviceToken: $invoice->inquiry->user->fcm_token,
                        );
                        Log::info(
                            'INVOICE UPDATED SEND PUSH NOTIFICATION: Invoice Was Paid!'
                        );
                    }
                } catch (\Exception $e) {
                    Log::error(
                        'INVOICE UPDATED SEND PUSH NOTIFICATION: ' . '[' . $e->getMessage() . '] '
                    );
                }
            }
        });
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class, 'inquiry_id', 'id');
    }
}
