<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeProduct extends BaseModel
{
    use HasFactory;

    protected $table = "type_products";
    protected $fillable = [
        'name',
        'status'
    ];

    public function badgeColor()
    {
        $badgeColor = [
            1    => 'primary',
            0    => 'danger',
        ];

        return $badgeColor[$this->status ?? ''];
    }

    /**
     * The products that belong to the TypeProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->hasMany(Product::class)->select('id');
    }
}
