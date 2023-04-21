<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends BaseModel
{
    use HasFactory;

    protected $table = 'product_prices';

    protected $fillable = [
        'status',
        'type_price_id',
        'amount'
    ];

    public function badgeColor()
    {
        $badgeColor = [
            1    => 'primary',
            0    => 'danger',
        ];

        return $badgeColor[$this->status ?? ''];
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = convertInFloat($amount);
    }

    public function getAmountAttribute($amount)
    {
        return $this->attributes['amount'] = convertFloat($amount);
    }

    /**
     * Get the type that owns the ProductPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypePrice::class,'type_price_id');
    }

    /**
     * Get the product that owns the priceProduct
     */
    public function product()
    {
        return $this->morphTo(__FUNCTION__, 'priceable_type', 'priceable_id');
    }
}
