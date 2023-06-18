<?php

namespace App\Models;

use App\Enums\UnitStatus;
use App\Enums\UnitActivation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Unit extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Defining spatie media collection
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->format('webp')
                    ->height(50);
                $this
                    ->addMediaConversion('responsive')
                    ->format('webp')
                    ->fit(Manipulations::FIT_STRETCH, 600, 400);
            });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'units';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status'     => UnitStatus::class,
        'activation' => UnitActivation::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = ['name_en', 'name_ar'];

    /**
     * fields that will handle upload document
     */
    const UPLOADFIELDS = [];

    ##--------------------------------- RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function capacity()
    {
        return $this->belongsTo(Capacity::class);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function pools()
    {
        return $this->belongsToMany(Pool::class);
    }

    public function kitchens()
    {
        return $this->belongsToMany(Kitchen::class);
    }

    public function toilets()
    {
        return $this->belongsToMany(Toilet::class);
    }

    public function views()
    {
        return $this->belongsToMany(View::class);
    }

    public function unitData()
    {
        return $this->hasOne(UnitData::class);
    }

    public function times()
    {
        return $this->hasMany(Time::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS


    ##--------------------------------- SCOPES
    public function scopeReview($query)
    {
        $query->where('status', UnitStatus::REVIEW);
    }

    public function scopePublished($query)
    {
        $query->where('status', UnitStatus::PUBLISHED);
    }

    public function scopeOwner($query)
    {
        $query->where('user_id', Auth::guard('owner')->user()->id);
    }

    ##--------------------------------- ACCESSORS & MUTATORS
}
