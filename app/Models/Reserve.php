<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserve extends BaseModel
{
    use HasFactory;

    protected $table = "reserves";

    public function getHourAttribute($hour) 
    {
        return $this->attributes['hour'] = convertTimeInHour($hour);
    }

    /**
     * Get the product that owns the Reserve
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all of the user for the Reserve
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
