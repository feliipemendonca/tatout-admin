<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends BaseModel
{
    use HasFactory;

    protected $table = "availabilities";
    protected $fillable = [
        'day',
        'date',
        'time',
        'amount',
        'quantity',
        'status_id',
        'type_price_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'amount' => 'float'
    ];

    public function userBadgeColor()
    {
        $badgeColor = [
            1    => 'primary',
            2    => 'danger',
            3    => 'warning',
        ];

        return $badgeColor[$this->status_id ?? ''];
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = convertInFloat($amount);
    }

    public function setTimeAttribute($time)
    {
        $this->attributes['time'] = convertInTimeInt($time);
    }

    public function getAmountAttribute($amount)
    {
        return $this->attributes['amount'] = convertFloat($amount);
    }

    public function getAmount()
    {
        return $this->attributes['amount'];
    }

    public function getTimeAttribute($time) 
    {
        return $this->attributes['time'] = convertTimeInHour($time);
    }

    public function availabisable()
    {
        return $this->morphTo();
    }

    /**
     * Get the status that owns the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the type that owns the Availability
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypePrice::class, 'type_price_id');
    }

    public function setData(&$model, $request)
    {
        $model->date = Carbon::createFromFormat('Y-m-d', $request['date'])->format('Y-m-d');
        $model->time = $request['time'];
        $model->amount = $request['amount'];
        $model->quantity = $request['quantity'];
        $model->status_id = $request['status_id'];
        $model->type_price_id = $request['type_price_id'];
    }
}
