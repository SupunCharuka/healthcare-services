<?php

namespace App\Models;

use App\Services\FirebaseCloudMessage;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;

class Inquiry extends Model
{
    use Loggable;
    use SoftDeletes;

    protected $fillable = [
        'service_category_id',
        'user_id',
        'district_id',
        'city_id',
        'service_id',
        'is_video_call',
        'status',
        'cost',
        'name',
        'email',
        'phone',
        'member_status',
        'latitude',
        'longitude',
        'created_by',
        'duration',
        'appointment_datetime',
        'is_reminder_sent',
        'view_status'
    ];

    protected $casts = [
        'is_video_call' => 'boolean'
    ];

    protected static function booted()
    {
        //        static::created(function (self $inquiry) {
        //            $fcmClient = new FirebaseCloudMessage;
        //        });

        // static::updated(function (self $inquiry) {
        //     try {
        //         $fcmClient = new FirebaseCloudMessage;
        //         if ($inquiry->service_id !== null) {
        //             $fcmClient->sendPushNotification(
        //                 title: "You have a new Inquiry",
        //                 body: "Your {$inquiry->service->title} has a new Inquiry, We will inform you when the customer confirms it",
        //                 routeName: "inquiries/view/{$inquiry->id}",
        //                 deviceToken: $inquiry->service->user->fcm_token,
        //             );
        //         }

        //         if ($inquiry->isDirty('service_id')) {
        //             $invoice = $inquiry->invoice;
        //             if ($invoice->amount > 0 && !$invoice->paid) {
        //                 $amount = number_format($invoice->amount, 2);
        //                 $fcmClient->sendPushNotification(
        //                     title: "New Invoice created!",
        //                     body: "Your inquiry {$inquiry->serviceCategory->name} accepted & invoice created. Kindly confirm with payment.",
        //                     routeName: "customer/invoice/{$inquiry->id}",
        //                     deviceToken: $inquiry->user->fcm_token,
        //                 );
        //                 Log::info(
        //                     'INQUIRY UPDATED SEND PUSH NOTIFICATION: New Invoice created!'
        //                 );
        //             }
        //         }
        //     } catch (\Exception $e) {
        //         Log::info(
        //             'INQUIRY UPDATED SEND PUSH NOTIFICATION: ' . '[' . $e->getMessage() . '] '
        //         );
        //     }
        // });

    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault();
    }

    public function province()
    {
        return $this->belongsTo(Province::class)->withDefault(new City);
    }

    public function district()
    {
        return $this->belongsTo(District::class)->withDefault(new City);
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault(new City);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id')->withDefault();
    }

    public function inputDetails()
    {
        return $this->hasMany(InputDetaile::class, 'inquiry_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'inquiry_id', 'id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'inquiry_id', 'id');
    }

    public function myreviews()
    {
        return $this->hasManyThrough(Review::class, Inquiry::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'inquiry_id', 'id')->withDefault(new Invoice);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(InquiryConversation::class, 'inquiry_id', 'id');
    }

    public function latestConversation(): HasOne
    {
        return $this->hasOne(InquiryConversation::class, 'inquiry_id', 'id')
            ->latest()
            ->withDefault();
    }
}
