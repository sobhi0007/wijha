<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
use App\Models\Unit;
use Laravel\Scout\Searchable;
class City extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use Searchable;
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_en')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
// spatie media file 
    /**
     * Defining spatie media collection
     */
    public function registerMediaCollections(): void
    {
        $this 
            ->addMediaCollection('image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->format('webp')
                    ->height(50);

                    $this
                    ->addMediaConversion('responsive')
                    ->format('webp')
                    ->fit(Manipulations::FIT_STRETCH, 200, 313);
            });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['featured','name_ar', 'name_en ','slug'];

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
        // 'status' => Status::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = ['name_en', 'name_ar'];

    /**
     * fields that will handle upload document
     */
    const UPLOADFIELDS = ['image'];

    ##--------------------------------- RELATIONSHIPS
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS


    ##--------------------------------- SCOPES
    // public function scopeActive($query)
    // {
    //     $query->where('status', Status::ACTIVE);
    // }


    ##--------------------------------- ACCESSORS & MUTATORS

    public function toSearchableArray()
    {
            return [
            'slug' => $this->slug,
          
        ];
    }
}
