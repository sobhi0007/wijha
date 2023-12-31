<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'badges';

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
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * fields ordering in filteration
     */
    const ORDER = ['name_en', 'name_ar'];

    /**
     * fields that will handle upload document
     */
    const UPLOADFIELDS = [];

    ##--------------------------------- RELATIONSHIPS
    // public function branches() {
    //     return $this->hasMany(Branch::class);
    // }


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS


    ##--------------------------------- SCOPES
    // public function scopeActive($query)
    // {
    //     $query->where('status', Status::ACTIVE);
    // }


    ##--------------------------------- ACCESSORS & MUTATORS
    // public function setNameAttribute($value) {
    //     $this->{'name_'.App::getLocale()} = $value;

        
    // }
    
    protected $appends = ['name'];
    
    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $this->attributes['name_' . $locale];
    }
}
