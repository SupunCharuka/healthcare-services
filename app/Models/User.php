<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Storage;
use Intervention\Image\Facades\Image;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use Loggable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'slmc_number',
        'is_hotel',
        'phone',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
        'google_avatar',
        'facebook_id',
        'facebook_token',
        'facebook_refresh_token',
        'facebook_avatar',
        'member_type',
        'gender',
        'fcm_token',
        'phone_verified_at',
        'deactivated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_hotel' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            $imagePath = $photo->storePublicly(
                'uploads/profile-photos',
                ['disk' => $this->profilePhotoDisk()]
            );

            // Resize the image
            $resizedImagePath = $this->resizeImage($imagePath, 300, 300);

            $this->forceFill([
                'profile_photo_path' => $resizedImagePath,
            ])->save();

            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    private function resizeImage($imagePath, $width, $height)
    {
        $image = Image::make(Storage::disk($this->profilePhotoDisk())->get($imagePath));
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizedImagePath = $imagePath;

        Storage::disk($this->profilePhotoDisk())->put($resizedImagePath, $image->stream());

        return $resizedImagePath;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('exclude_deleted', function ($query) {
            $query->whereNull('deleted_at');
        });
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
            : ($this->google_avatar
                ? $this->google_avatar
                : ($this->facebook_avatar
                    ? $this->facebook_avatar
                    : $this->defaultProfilePhotoUrl()
                )
            );
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class, 'user_id');
    }

    public function inquiryConversations(): HasMany
    {
        return $this->hasMany(InquiryConversation::class, 'sender_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'user_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function ticketReplies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'admin_id');
    }

    public function education()
    {
        return $this->hasMany(Education::class, 'user_id', 'id');
    }

    public function workDetails()
    {
        return $this->hasMany(WorkDetail::class, 'user_id', 'id');
    }

    public function memberRegister()
    {
        return $this->hasOne(MemberRegister::class, 'user_id', 'id')->withDefault();
    }

    public function healthProfiles()
    {
        return $this->hasMany(HealthProfile::class, 'user_id', 'id');
    }

    public function business(): HasOne
    {
        return $this->hasOne(Business::class, 'user_id')->withDefault();
    }

    public function generateAndStoreVerificationCode($phone)
    {
        $rand_no = rand(100000, 999999);
        $hashed_code = hash("sha512", $rand_no);
        $hashed_phone = hash("sha512", $phone);
        session()->put($hashed_phone, $hashed_code);
        return $rand_no;
    }
}
