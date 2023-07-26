<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Unit;
use App\Models\Review;
use App\Enums\UserType;
use App\Models\Booking;
use App\Models\Wishlist;
use App\Enums\UserApproval;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'fcm_token',
        'type',
        'percentage',
        'approval',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserType::class,
        'approval' => UserApproval::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = ['name', 'email'];

    ##--------------------------------- RELATIONSHIPS
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS
    public function nameOnHeader()
    {
        if (strlen($this->name) > 10) {
            return \substr($this->name, 0, 10) . '..';
        }
        return $this->name;
    }


    ##--------------------------------- SCOPES
    public function scopeUser($query)
    {
        $query->where('type', UserType::USER);
    }

    public function scopeOwner($query)
    {
        $query->where('type', UserType::OWNER);
    }


    ##--------------------------------- ACCESSORS & MUTATORS    
    /**
     * Interact with the user's password
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if ($value != null) {
                    return bcrypt($value);
                }
            },
        );
    }
}
