<?php

namespace App\Models;

use App\Enums\ReviewStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

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
        'status' => ReviewStatus::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = ['accuracy', 'cleanliness', 'services', 'location'];

    /**
     * fields that will handle upload document
     */
    const UPLOADFIELDS = [];

    ##--------------------------------- RELATIONSHIPS
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS


    ##--------------------------------- SCOPES
    public function scopeOwner($query)
    {
        $query->whereHas('booking', function ($q) {
            $q->whereHas('unit', function ($qu) {
                $qu->where('user_id', Auth::guard('owner')->user()->id);
            });
        });
    }

    public function scopePublished($query)
    {
        $query->where('status', ReviewStatus::ACTIVE);
    }


    ##--------------------------------- ACCESSORS & MUTATORS
}
