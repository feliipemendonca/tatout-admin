<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Product extends BaseModel
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'type_product_id',
        'status',
        'name',
        'description',
        'amount'  
    ];

        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'productble_type',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = convertInFloat($amount);
    }

    public function badgeColor()
    {
        $badgeColor = [
            1    => 'primary',
            0    => 'danger',
        ];

        return $badgeColor[$this->status ?? ''];
    }

    public function setData(&$product, $request)
    {
        $product->name = $request['name'];
        $product->status = $request['status'];
        $product->description = $request['description'];
        $product->amount = $request['amount'];
        $product->type_product_id = $request['type_product_id'];
    }

    /**
     * Get the type that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeProduct::class,'type_product_id');
    }

    /**
     * Get the files that owns the User
     *
     * @return MorphMany
     */
    public function file()
    {
        return $this->morphMany(File::class, 'fileble');
    }

    /**
     * Get the prices that owns the User
     *
     * @return MorphMany
     */
    public function prices()
    {
        return $this->morphMany(ProductPrice::class, 'priceable');
    }

    /**
     * Get the availabilitys that owns the User
     *
     * @return MorphMany
     */
    public function availabilitys()
    {
        return $this->morphMany(Availability::class, 'availabisable');
    }

    /**
     * Get the company that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'id');
    }

    /**
     * Get the productble that owns the User
     *
     * @return MorphTo
     */
    public function productble()
    {
        return $this->morphTo();
    }

    private static function containProduct()
    {
        return self::query()
            ->select(
                'id',
                'type_product_id',
                'productble_id',
                'status',
                'name',
                'description',
                'amount',
                'slug'
            )->where('status',true);
    }

    private static function containWithProduct(&$query) 
    {
        $query = self::with([
            'type:id,name',
            'productble:id,name,slug',
            'file' => function($q) {
                $q->select(
                    'id',
                    'fileble_id',
                    DB::raw('CONCAT("'.config('app.url').'", path) as path')
                );
            },
            'prices' => function($q) {
                $q->select(
                    'id',
                    'type_price_id',
                    'priceable_id',
                    'status',
                    'amount',
                )->with([
                    'type:id,name'
                ])->where('status',true);
            }
        ]);

        return $query;
    }

    public static function customBuildQueryAllProducts()
    {
        $query = self::containProduct();
        self::containWithProduct($query);

        return $query->get();
    }

    public static function customBuildQueryFindProduct($id)
    {
        $query = self::containProduct();
        self::containWithProduct($query);

        return $query->findOrFail($id);
    }
}
